<?php

namespace App\Http\Controllers;

use Rebilly\Entities\SubscriptionCancel;
use Rebilly\Entities\SubscriptionSwitch;
use Rebilly\Http\Exception\UnprocessableEntityException;
use Rebilly\Http\Exception\NotFoundException;
use Rebilly\ParamBag;
use Rebilly\Rest\File;
use RuntimeException;

class UserController extends Controller
{
    protected $layout = 'layouts.master';

    public function login()
    {
        if (isset($_POST['Login'])) {
            try {
                $authToken = $this->client()->authenticationTokens()->login($_POST['Login']);
                $this->setSession([
                    'customerId' => $authToken->getCustomerId(),
                    'credentialId' => $authToken->getCredentialId(),
                    'username' => $authToken->getUsername(),
                    'token' => $authToken->getToken(),
                ]);

                return redirect('/profile');
            } catch (UnprocessableEntityException $e) {
                $errors[] = 'username or password not found';
            }
        }

        return view($this->layout, [
            'content' => view('user.login', ['errors' => isset($errors) ? $errors : null]),
        ]);
    }

    public function logout()
    {
        $this->unsetSession();
        return redirect('/');
    }

    public function profile()
    {
        try {
            $customer = $this->client()->customers()->load($_SESSION['customerId']);
            $subscriptions = $this->client()->subscriptions()->search([
                'filter' => 'customerId:' . $_SESSION['customerId'],
                'expand' => 'plan',
            ]);
            $transactions = $this->client()->transactions()->search([
                'filter' => 'customerId:' . $_SESSION['customerId'],
                'expand' => 'paymentCard',
            ]);
            $paymentCards = $this->client()->paymentCards()->search([
                'filter' => 'customerId:' . $_SESSION['customerId'],
            ]);

            return view($this->layout, [
                'content' => view('user.profile', [
                    'customer' => $customer,
                    'paymentCards' => $paymentCards,
                    'subscriptions' => $subscriptions,
                    'transactions' => $transactions,
                ]),
            ]);
        } catch (NotFoundException $e) {
            return redirect(url('/login'));
        }
    }

    public function editCustomer()
    {
        try {
            $customer = $this->client()->customers()->load($_SESSION['customerId']);
        } catch (NotFoundException $e) {
            return redirect('/login');
        }
        if (isset($_POST['Customer'])) {
            try {
                $this->client()->customers()->update($_SESSION['customerId'], $_POST['Customer']);
                return redirect(url('/profile'));
            } catch (UnprocessableEntityException $e) {
                $errors = $e->getErrors();
            }
        }

        return view($this->layout, [
            'content' => view('user.editCustomer', [
                'customer' => $customer,
                'errors' => isset($errors) ? $errors : null,
            ]),
        ]);
    }

    public function paymentMethod()
    {
        try {
            $customer = $this->client()->customers()->load($_SESSION['customerId']);
            $paymentCards = $this->client()->paymentCards()->search(['filter' => 'customerId:' . $_SESSION['customerId']]);
        } catch (NotFoundException $e) {
            return redirect('/login');
        }
        if (isset($_POST['PaymentMethod']['defaultCardId'])) {
            try {
                $customer = $this->client()->customers()->load($_SESSION['customerId']);
                $customer->setDefaultCardId($_POST['PaymentMethod']['defaultCardId']);
                $customer = $this->client()->customers()->update($customer->getId(), $customer);
                return redirect(url('/profile'));
            } catch (UnprocessableEntityException $e) {
                $errors = $e->getErrors();
            }
        }

        return view($this->layout, [
            'content' => view('user.paymentMethods', [
                'customer' => $customer,
                'paymentCards' => $paymentCards,
                'errors' => isset($errors) ? $errors : null,
            ]),
        ]);
    }

    public function addPaymentMethod()
    {
        if (isset($_POST['rebillyToken'])) {
            try {
                $this->client()->paymentCards()->createFromToken($_POST['rebillyToken'], [
                    'customerId' => $_SESSION['customerId'],
                ]);
                return redirect(url('/manage-payment-methods'));
            } catch (UnprocessableEntityException $e) {
                $errors = $e->getErrors();
            }
        }

        return view($this->layout, [
            'content' => view('user.addPaymentMethod', [
                'errors' => isset($errors) ? $errors : null,
            ]),
        ]);
    }

    public function changePassword()
    {
        if (isset($_POST['Password'])) {
            try {
                $this->client()->authenticationTokens()->login([
                    'username' => $_SESSION['username'],
                    'password' => $_POST['Password']['old'],
                ]);

                $this->client()->customerCredentials()->update($_SESSION['credentialId'], [
                    'username' => $_SESSION['username'],
                    'password' => $_POST['Password']['new'],
                ]);

                return redirect(url('/profile'));
            } catch (UnprocessableEntityException $e) {
                $errors = $e->getErrors();
            }
        }

        return view($this->layout, [
            'content' => view('user.changePassword', [
                'errors' => isset($errors) ? $errors : null,
            ]),
        ]);
    }

    public function subscriptions()
    {
        $subscriptions = $this->client()->subscriptions()->search([
            'filter' => 'customerId:' . $_SESSION['customerId'],
            'expand' => 'plan',
        ]);

        return view($this->layout, [
            'content' => view('user.subscription', ['subscriptions' => $subscriptions]),
        ]);
    }

    public function createSubscription()
    {
        $plans = $this->client()->plans()->search();
        if (isset($_POST['Subscription'])) {
            try {
                $subscription = $this->client()->subscriptions()->create(array_merge(
                    [
                        'customerId' => $_SESSION['customerId'],
                        'websiteId' => getenv('REBILLY_WEBSITE'),
                    ],
                    $_POST['Subscription']
                ));
                if ($subscription->getCancelledTime() === null) {
                    return redirect(url('/subscriptions'));
                }
                // it was cancelled, probably because payment declined:
                $errors[] = 'Subscription could not be created. Please try with a different payment method.';
            } catch (UnprocessableEntityException $e) {
                $errors = $e->getErrors();
            }
        }

        return view($this->layout, [
            'content' => view('user.createSubscription', [
                'plans' => $plans,
                'errors' => isset($errors) ? $errors : null,
            ]),
        ]);
    }

    public function switchSubscription($subscriptionId)
    {
        try {
            $subscription = $this->client()->subscriptions()->load($subscriptionId);
            $plans = $this->client()->plans()->search();
            // Check if subscription is belong to the customer
            if ($subscription->getCustomerId() !== $_SESSION['customerId']) {
                return redirect(url('/profile'));
            }
        } catch (NotFoundException $e) {
            return redirect(url('/subscriptions'));
        }

        if (isset($_POST['Subscription'])) {
            $params = array_merge(
                [
                    'policy' => SubscriptionSwitch::NOW_WITH_PRORATA_REFUND,
                ],
                $_POST['Subscription']
            );
            try {
                $subscription = $this->client()->subscriptions()->switchTo($subscriptionId, $params);
                if ($subscription->getCancelledTime() === null) {
                    return redirect(url('/subscriptions'));
                }
                $errors[] = 'Could not switch subscription';

            } catch (UnprocessableEntityException $e) {
                $errors = $e->getErrors();
            }
        }

        return view($this->layout, [
            'content' => view('user.switchSubscription', [
                'plans' => $plans,
                'subscription' => $subscription,
                'errors' => isset($errors) ? $errors : null,
            ]),
        ]);
    }

    public function cancelSubscription($subscriptionId)
    {
        try {
            $subscription = $this->client()->subscriptions()->load($subscriptionId);
            // Check if subscription is belong to the customer
            if ($subscription->getCustomerId() !== $_SESSION['customerId']) {
                return redirect(url('/profile'));
            }
            $this->client()->subscriptions()->cancel($subscriptionId, ['policy' => SubscriptionCancel::AT_NEXT_REBILL]);
        } catch (UnprocessableEntityException $e) {
            return $e->getErrors();
        } catch (NotFoundException $e) {
            return redirect(url('/subscriptions'));
        }

        return redirect(url('/subscriptions'));
    }

    public function billingHistory()
    {
        $invoices = $transactions = $this->client()->invoices()->search([
            'filter' => 'customerId:' . $_SESSION['customerId'],
        ]);
        return view($this->layout, [
            'content' => view('user.billingHistory', [
                'customerId' => $_SESSION['customerId'],
                'invoices' => $invoices,
            ]),
        ]);
    }

    public function closeAccount()
    {
        $customerId = $_SESSION['customerId'];

        if (isset($_POST['Customer']['reason'])) {
            $reason = $_POST['Customer']['reason'];
            if ($reason === 'Other') {
                $reason = $_POST['Customer']['other'];
            }

            try {
                // save a cancel reason to a custom field:
                $customer = $this->client()->customers()->load($customerId);
                $customer->setCustomFields(['cancelReason' => $reason]);
                $this->client()->customers()->update($customerId, $customer);

                // cancel all active subscriptions:
                $filters = (new ParamBag())->filter('customerId', $customerId);
                $subscriptions = $this->client()->subscriptions()->search($filters);
                foreach ($subscriptions as $subscription) {
                    if ($subscription->getStatus() === 'Active')
                    $this->client()->subscriptions()->cancel($subscription->getId(), ['policy' => SubscriptionCancel::AT_NEXT_REBILL]);
                }
            } catch (UnprocessableEntityException $e) {
                // log what happened...
            }
            return redirect(url('/profile'));
        }
        return view($this->layout, [
            'content' => view('user.closeAccount', [
                'customerId' => $customerId,
            ]),
        ]);
    }

    public function downloadInvoice($invoiceId)
    {
        $file = $this->client()->invoices()->loadPdf($invoiceId, [
            'customerId' => $_SESSION['customerId'],
        ]);

        if ($file instanceof File) {
            $filename = tempnam(sys_get_temp_dir(), 'Invoice') . '.pdf';
            $file->save($filename);

            if(is_file($filename)) {
                header('Pragma: public');
                header('Expires: 0');
                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($filename)) . ' GMT');
                header('Cache-Control: private', false);
                header('Content-Type: ' . $file->getMimeType());
                header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
                header('Content-Transfer-Encoding: binary');
                header('Content-Length: ' . filesize($filename));
                header('Connection: close');
                readfile($filename);
                exit();
            }
        } else {
            throw new RuntimeException('Cannot download file');
        }
    }
} 
