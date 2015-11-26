@section('layoutType', 'user')
@section('title', 'User Profile')
@section('content')
<?php
    $subscriptionStatus = '';
    $subscriptionCss = '';
?>

<div class="ui grid container user">
    <div class="sixteen wide column">
        <h2 class="ui header title color brand">Account Management</h2>
        <div class="ui segment management">
            <div class="section">
                <h5 class="title">Account Information</h5>
                <div class="details">
                    <div class="ui top aligned relaxed divided large list">
                        <div class="item">
                            <img class="ui avatar image" src="<?= url('assets/img/user_pic.jpg') ?>">
                            <div class="content">
                                <div class="header"><?= $customer->getFirstName() . ' ' . $customer->getLastName() ?></div>
                                <div class="description"><?= $customer->getEmail() ?></div>
                                <?php if (isset($customer->getCustomFields()['company'])): ?>
                                <div class="description"><?= $customer->getCustomFields()['company'] ?></div>
                                <?php endif ?>
                                <?php if (isset($customer->getCustomFields()['position'])): ?>
                                <div class="description"><?= $customer->getCustomFields()['position'] ?></div>
                                <?php endif ?>
                                <?php if (isset($customer->getCustomFields()['industry'])): ?>
                                <div class="description"><?= $customer->getCustomFields()['industry'] ?></div>
                                <?php endif ?>
                                <?php if (isset($customer->getCustomFields()['phone'])): ?>
                                <div class="description"><?= $customer->getCustomFields()['phone'] ?></div>
                                <?php endif ?>
                                <?php if (isset($customer->getCustomFields()['country'])): ?>
                                <div class="description"><?= $customer->getCustomFields()['country'] ?></div>
                                <?php endif ?>
                            </div>
                            <div class="right floated content">
                                <a href="<?= url('/edit-customer') ?>" class="contact">Edit contact info</a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="left floated content">Password: ***************</div>
                            <div class="right floated content">
                                <a href="<?= url('/change-password') ?>" class="password">Change password</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section">
                <h5 class="title">Plans</h5>
                <div class="details">
                    <div class="ui top aligned relaxed divided large list">
                        <div class="item">
                            <div class="left floated content">
                                <?php foreach ($subscriptions as $subscription) : ?>
                                <?php if ($subscription->getStatus() !== 'Cancelled'): ?>
                                <div class="header">
                                    <?= $subscription->getQuantity() ?> x <?= $subscription->getPlan()->getName() ?> - <?= $subscription->getPlan()->getCurrencySign() . $subscription->getPlan()->getRecurringAmount() . '/' . $subscription->getPlan()->getRecurringPeriodLength() . ' ' . $subscription->getPlan()->getRecurringPeriodUnit() ?>
                                </div>
                                <div class="description plans">
                                    <?php if ($subscription->getRenewalTime()) : ?>
                                        <span class="cycle">Your next bill: <?= date('Y-m-d', strtotime($subscription->getRenewalTime())) ?></span>
                                    <? endif ?>
                                    <?php if ($subscription->getEndTime()) : ?>
                                        <span class="cycle">Your subscription will end on: <?= date('Y-m-d', strtotime($subscription->getEndTime())) ?></span>
                                    <? endif ?>
                                    <br>
                                    Registered since: <?= date('Y-m-d', strtotime($subscription->getstartTime())) ?>
                                </div>
                                <?php endif ?>
                                <?php endforeach ?>
                            </div>
                            <div class="right floated content">
                                <a href="<?= url('/subscriptions') ?>">Manage your subscriptions</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section">
                <h5 class="title">Payment</h5>
                <div class="details">
                    <div class="ui top aligned relaxed divided large list">
                        <div class="item">
                            <?php foreach ($paymentCards as $paymentCard): ?>
                            <div class="left floated content">
                                <?php if ($paymentCard->getId() === $customer->getDefaultCardId()): ?>
                                <i class="<?= strtolower($paymentCard->getBrand()) ?> paymentCard icon"></i>&nbsp;&nbsp;<span class="secret cc">•••• •••• ••••</span>&nbsp;<span class="lastfour"><?= $paymentCard->getLast4() ?></span>
                                <?php endif ?>
                            </div>
                            <?php endforeach ?>
                            <div class="right floated content">
                                <a href="<?= url('/manage-payment-methods') ?>" class="payments">Manage payment method</a>
                                <a href="<?= url('/billing-history') ?>" class="billing">View billing history</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section">
                <h5 class="title">Settings</h5>
                <div class="details">
                    <div class="ui top aligned relaxed divided large list">
                        <div class="item">
                            <?php foreach ($subscriptions as $subscription):
                                $subscriptionStatus = $subscription->getStatus();
                                if ($subscriptionStatus === 'Active'):
                                    $subscriptionCss = 'green';
                                    break;
                                elseif ($subscriptionStatus === 'Trial'):
                                    $subscriptionCss = 'blue';
                                else:
                                    $subscriptionCss = 'red';
                                endif;
                            endforeach;
                            ?>
                            <div class="left floated content">Account Status: <div class="ui <?= $subscriptionCss ?> horizontal small label"><?= $subscriptionStatus ?></div></div>
                            <div class="right floated content">
                                <a href="<?= url('/close-account') ?>" class="closeAccount">Close my account</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ui tiny grey center aligned header footer transition hidden">
            Copyright&copy; All rights reserved.
        </div>
    </div>
</div>
@endsection
