@section('layoutType', 'user')
@section('title', 'User Profile')
@section('content')

<div class="ui stackable grid centered container user">
    <div class="eleven wide column">
        <h2 class="ui header title color brand">Manage Payment Method</h2>
        <div class="ui segment management">
            <form class="ui form" method="post">
                <div class="section">
                    <div class="payment method">
                        <h4>Select your default payment method</h4>
                        <?php foreach ($paymentCards as $paymentCard): ?>
                        <?php $brand = strtolower($paymentCard->getBrand()) ?>
                        <input type="radio" id="<?= $paymentCard->getId() ?>" name="PaymentMethod[defaultCardId]" value="<?= $paymentCard->getId() ?>" <?= $customer->getDefaultCardId() === $paymentCard->getId() ? 'checked="checked"' : '' ?>>
                        <label for="<?= $paymentCard->getId() ?>">
                            <div class="ui stackable middle aligned grid">
                                <div class="twelve wide column">
                                    <div class="ui top aligned relaxed divided large list">
                                        <i class="<?= $brand === 'american_express' ? 'amex' : $brand ?> large icon"></i>&nbsp;&nbsp;
                                        <span class="secret cc">•••• •••• ••••</span>&nbsp;<span class="lastfour"><?= $paymentCard->getLast4() ?></span>
                                        <br>
                                        <small><?= $paymentCard->getBrand() ?> - Exp: <?= $paymentCard->getExpMonth() ?>/<?= $paymentCard->getExpYear() ?></small>
                                    </div>
                                </div>
                            </div>
                        </label>
                        <?php endforeach ?>
                    </div>
                    <a href="<?= url('/add-payment-method') ?>" class="ui brand color mini button addPayment"><i class="icon plus"></i>Add new payment method</a>
                    <div class="ui hidden divider"></div>
                    <div class="ui divider"></div>
                    <div class="actions">
                        <a href="<?= url('/profile') ?>" class="ui negative cancel button payments">Cancel</a>
                        <button type="submit" class="ui positive approve button payments">Save</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="ui tiny grey center aligned header footer">
            Copyright&copy; All rights reserved.
        </div>
    </div>
</div>
@endsection
