@section('layoutType', 'user')
@section('title', 'Manage your plans')
@section('content')

<div class="ui stackable grid centered container user">
    <div class="eleven wide column">
        <h2 class="ui header title color brand">Add new subscription</h2>
        <div class="ui segment management">
            <div class="section">
                <?php if (isset($errors)):?>
                <div class="ui error message">
                    <strong>Please check the following:</strong>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                        <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="ui hidden divider"></div>
                <?php endif ?>
            </div>
            <form class="ui form" method="post">
                <div class="field">
                    <label>Select Plan</label>
                    <div class="select layout  ">
                        <?php foreach ($plans as $plan): ?>
                        <?php /** @var $plan \Rebilly\Entities\Plan */ ?>
                        <input type="radio" value="<?= $plan->getId() ?>" id="plan-<?= $plan->getId() ?>" name="Subscription[planId]">
                        <label for="plan-<?= $plan->getId() ?>">
                            <div class="ui stackable middle aligned grid">
                                <div class="eight wide column">
                                    <span class="layout name"><?= $plan->getName() ?></span>
                                    <br>
                                    <p><?= $plan->getDescription() ?></p>
                                </div>
                                <div class="eight wide right aligned column">
                                    <h1 class="price"><span class="currency"><?= $plan->getCurrencySign() . $plan->getRecurringAmount() . '/' . $plan->getRecurringPeriodLength() . ' ' . $plan->getRecurringPeriodUnit() ?></span></h1>
                                </div>
                            </div>
                        </label>
                        <?php endforeach ?>
                    </div>
                </div>
                <div class="ui hidden divider"></div>
                <div class="three wide field">
                    <label>Select Quantity</label>
                    <?php /** @var $subscription \Rebilly\Entities\Subscription */ ?>
                    <input type="text" name="Subscription[quantity]" value="1">
                </div>
                <div class="ui hidden divider"></div>
                <div class="ui divider"></div>
                <div class="actions">
                    <a class="ui negative cancel button" href="<?= url('/subscriptions') ?>">Cancel</a>
                    <button type="submit" class="ui positive approve button">Save</button>
                </div>
            </form>
        </div>
        <div class="ui tiny grey center aligned header footer">
            Copyright&copy; All rights reserved.
        </div>
    </div>
</div>
@endsection
