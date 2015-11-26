<?php

namespace App\Http\Controllers;

use Rebilly\Http\Exception\HttpException;
use Rebilly\Http\Exception\NotFoundException;
use Rebilly\Http\Exception\UnprocessableEntityException;

class MainController extends Controller
{
    protected $layout = 'layouts.master';

    public function index()
    {
        $layout = $this->client()->layouts()->load(getenv('REBILLY_LAYOUT_ID'));

        return view($this->layout, [
            'content' => view('account.plan', ['layoutItems' => $layout->getItems()])
        ]);
    }

    public function createAccount($planId)
    {
        if (isset($_POST['Customer'], $_POST['Credential']['password'])) {
            try {
                // create the customer:
                $customer = $this->client()->customers()->create($_POST['Customer']);

                // create the auth credentials:
                $this->client()->customerCredentials()->create([
                    'customerId' => $customer->getId(),
                    'username' => $customer->getEmail(),
                    'password' => $_POST['Credential']['password'],
                ]);

                // login and set session:
                $authToken = $this->client()->authenticationTokens()->login([
                    'username' => $customer->getEmail(),
                    'password' => $_POST['Credential']['password'],
                ]);
                $this->setSession([
                    'customerId' => $customer->getId(),
                    'credentialId' => $authToken->getCredentialId(),
                    'username' => $authToken->getUsername(),
                    'token' => $authToken->getToken(),
                ]);

                return redirect(url('/billing', [
                    'planId' => $planId,
                ]));
            } catch (UnprocessableEntityException $e) {
                $errors = $e->getErrors();
            } catch (HttpException $e) {
                // log the error
                $errors[] = 'Try again';
            }
        }

        return view($this->layout, [
            'content' => view(
                'account.signup',
                [
                    'planId' => $planId,
                    'errors' => isset($errors) ? $errors : null, // could be replaced by `$errors ?? null` using php7 coalesce feature
                ]
            )
        ]);
    }

    /**
     * @param string $planId
     * @return \Illuminate\View\View
     */
    public function billing($planId)
    {
        $customerId = $_SESSION['customerId'];
        $plan = $this->client()->plans()->load($planId); // used to render the plan name at top of the page

        if (isset($_POST['Billing'], $_POST['rebillyToken'])) {
            try {
                // create a payment card from a token:
                $paymentCard = $this->client()->paymentCards()->createFromToken(
                    $_POST['rebillyToken'],
                    ['customerId' => $customerId]
                );

                // set the payment card as the default card:
                $customer = $this->client()->customers()->load($customerId);
                $customer->setDefaultCardId($paymentCard->getId());
                $this->client()->customers()->update($customerId, $customer);

                $invoice = $this->client()->invoices()->create([
                    'customerId' => $customerId,
                    'currency' => $plan->getCurrency(),
                    'websiteId' => getenv('REBILLY_WEBSITE'),
                ]);

                // create the subscription:
                $subscription = $this->client()->subscriptions()->create([
                    'customerId' => $customerId,
                    'planId' => $planId,
                    'websiteId' => getenv('REBILLY_WEBSITE'),
                    'initialInvoiceId' => $invoice->getId(),
                ]);

                if ($subscription->getCancelledTime() === null) {
                    return redirect(url('/success', ['subscriptionId' => $subscription->getId()]));
                } else {
                    return redirect(url('/declined', ['planId' => $planId]));
                }

            } catch (UnprocessableEntityException $e) {
                $errors = $e->getErrors();

            } catch (HttpException $e) {
                $errors[] = 'An error occurred.  Try again.';
            }
        }

        return view($this->layout, [
            'content' => view('account.billing', [
                'plan' => $plan,
                'errors' =>  isset($errors) ? $errors : null,
            ])
        ]);
    }

    public function success($subscriptionId)
    {
        try {
            $subscription = $this->client()->subscriptions()->load($subscriptionId, [
                'expand' => 'plan',
            ]);
            $customer = $this->client()->customers()->load($_SESSION['customerId'], [
                'expand' => 'defaultCard',
            ]);
            $invoice = $this->client()->invoices()->load($subscription->getInitialInvoiceId());
            $website = $this->client()->websites()->load(getenv('REBILLY_WEBSITE'));
            return view($this->layout, [
                'content' => view('account.success', [
                    'subscription' => $subscription,
                    'customer' => $customer,
                    'invoice' => $invoice,
                    'website' => $website,
                ])
            ]);
        } catch (NotFoundException $e) {
            // Log error
        }
    }

    public function declined($planId)
    {
        return view($this->layout, [
            'content' => view('account.declined', [
                'planId' => $planId
            ])
        ]);
    }

    public function forgotPassword()
    {
        if (isset($_POST['Customer'])) {
            try {
                $token = $this->client()->resetPasswordTokens()->create($_POST['Customer']);
                if ($this->sendResetPassword($_POST['Customer']['username'], $token->getToken())) {
                    $message = 'Please check your email to reset your password.';
                }
            } catch (UnprocessableEntityException $e) {
                $errors = $e->getErrors();
            }
        }

        return view($this->layout, [
            'content' => view('account.forgotPassword', [
                'errors' => isset($errors) ? $errors : null,
                'message' => isset($message) ? $message : null,
            ]),
        ]);
    }

    public function resetPassword($token)
    {
        if (isset($_POST['password'], $_POST['confirmPassword']) &&
            ($_POST['password'] === $_POST['confirmPassword'])
        ) {
            if (!empty($_POST['password'])) {
                try {
                    $auth = $this->client()->resetPasswordTokens()->load($token);
                    $this->client()->customerCredentials()->update($auth->getCredentialId(), [
                        'username' => $auth->getUsername(),
                        'password' => $_POST['password'],
                    ]);
                    $message = 'Your password has been reset. Please go to <a href="/login">Login</a>';
                } catch (UnprocessableEntityException $e) {
                    $errors = $e->getErrors();
                } catch (NotFoundException $e) {
                    $errors = ['Invalid token'];
                }
            } else {
                $errors = ['Password cannot be blank.'];
            }
        }
        return view($this->layout, [
            'content' => view('account.resetPassword', [
                'errors' => isset($errors) ? $errors : null,
                'message' => isset($message) ? $message : null,
            ]),
        ]);
    }

    private function sendResetPassword($email, $token)
    {
        $subject = 'Reset Password';
        $body = view('mail.forgotPassword', ['resetLink' => url('/reset-password', ['token' => $token])]);

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
        $headers .= 'From: info@rebillydemo.com' . "\r\n";

        return mail($email, $subject, $body, $headers);
    }
} 
