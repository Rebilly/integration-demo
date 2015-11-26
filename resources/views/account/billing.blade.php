<?php
    use Rebilly\Util\RebillySignature;
    $auth = RebillySignature::generateSignature(getenv('REBILLY_API_USER'), getenv('REBILLY_API_KEY'));
    $rangeMonth = range(1, 12);
    $rangeYear = range(date('Y'), date('Y') + 20);
    $isTrial = isset($item['plan']['trialPeriodLength'], $item['plan']['trialPeriodUnit']);
    $amount = $plan->getSetupAmount() + ($isTrial ? $plan->getTrialAmount() : $plan->getRecurringAmount());
?>
@section('title', 'Billing')
@section('content')
<!-- Billing -->
<div class="ui centered container account stackable grid">
    <div class="row">
        <div class="center aligned column">
            <div class="ui huge centered header"><?= $plan->getName() ?></div>
            <h2 class="ui large centered grey header">Today's payment is: <?= $plan->getCurrencySign() . $amount ?></h2>
            <div class="ui hidden divider"></div>
        </div>
    </div>
    <div class="row">
        <div class="eleven wide tablet nine wide computer column">
            <div class="create">
                <h4 class="ui center aligned top attached inverted brand color header title">
                    BILLING INFORMATION
                </h4>
                <div class="ui bottom attached segment info">
                    <!-- Rebilly Token Errors -->
                    <div class="ui error message error-summary hidden">
                        <strong>Please check the following errors:</strong>
                        <ul></ul>
                    </div>
                    <?php if (isset($errors)): ?>
                        <div class="ui error message">
                            <strong>Please check the following errors:</strong>
                            <ul>
                                <?php foreach ($errors as $error): ?>
                                    <li><?= $error ?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    <?php endif ?>
                    <form class="ui form" id="form-billing" method="post">
                        <input type="hidden" data-rebilly="auth" value="<?= $auth ?>">
                        <div class="fields">
                            <div class="eight wide field">
                                <label>First Name</label>
                                <input type="text" name="Billing[firstName]" placeholder="John" data-rebilly="firstName">
                            </div>
                            <div class="eight wide field">
                                <label>Last Name</label>
                                <input type="text" name="Billing[lastName]" placeholder="Doe" data-rebilly="lastName">
                            </div>
                        </div>
                        <div class="fields">
                            <div class="five wide required field">
                                <label>Postal Code / ZIP</label>
                                <input type="text" name="Billing[postalCode]" data-rebilly="postalCode">
                            </div>
                            <div class="eleven wide required field">
                                <label>Country</label>
                                <?= view('partial.country', ['fieldName' => 'Billing[country]', 'selectedValue' => null]) ?>
                            </div>
                        </div>
                        <div class="fields">
                            <div class="eleven wide required field ">
                                <label>Credit Card Number</label>
                                <input type="text" data-rebilly="pan">
                            </div>
                            <div class="five wide required field">
                                <label class="cvv" data-html='
                                <div class="credit-card" style="display: block;">
                                    <div class="cc-cvv2">123</div>
                                    <div class="cc-mb"></div>
                                    <div class="cc-signature"></div>
                                    <div class="cc-pan-holder">
                                    <span class="cc-pan">0000 1111 2222 3333 444</span>
                                </div>
                            </div>'>CVV</label>
                                <input type="text" data-rebilly="cvv">
                            </div>
                        </div>
                        <div class="fields">
                            <div class="eight wide required field">
                                <label>Expiry Month</label>
                                <select data-rebilly="expMonth">
                                    <?php foreach ($rangeMonth as $month): ?>
                                    <option value="<?= $month ?>"><?= $month ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="eight wide required field">
                                <label>Expiry Year</label>
                                <select data-rebilly="expYear">
                                    <?php foreach ($rangeYear as $year): ?>
                                    <option value="<?= $year ?>"><?= $year ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <button class="ui fluid brand secondary color button billing-submit" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extraScript')
<script type="text/javascript" src="<?= getenv('REBILLY_JS_URL') ?>"></script>
<script src="<?= url('assets/js/rebilly.js') ?>"></script>
@endsection
