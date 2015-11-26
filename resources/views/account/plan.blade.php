@section('title', 'Select a plan')
@section('content')
<!-- Plans -->
<div class="ui container plans equal width stackable grid">
    <div class="row">
        <div class="center aligned column">
            <div class="ui huge centered header">Select your plan</div>
            <div class="ui hidden divider"></div>
            <div class="ui hidden divider"></div>
        </div>
    </div>
    <div class="row">
        @foreach ($layoutItems as $item)
        <?php
            $isStarredCss = $item['starred'] ? ' recommended' : '';
            $isTrial = isset($item['plan']['trialPeriodLength'], $item['plan']['trialPeriodUnit']);
        ?>
        <div class="column">
            <div class="plan <?= $isStarredCss ?>">
                <h4 class="ui center aligned top attached header title color brand">
                    <?= $item['plan']->getName() ?>
                </h4>
                <div class="ui center aligned bottom attached segment info">
                    <p><?= $item['plan']->getDescription() ?></p>
                    <h1 class="price"><span class="currency"><?= $item['plan']->getCurrencySign() ?></span><?= $item['plan']->getRecurringAmount() ?></h1>
                    <?php if($isTrial): ?>
                    <span class="message">Try our plan</span>
                    <?php else: ?>
                    <?php $planLength = (int)$item['plan']['recurringPeriodLength'] === 1 ? '' : $item['plan']['recurringPeriodLength'] . ' '; ?>
                    <span class="message"><?= $item['plan']->getCurrencySign() . $item['plan']['recurringAmount'] . ' PER ' . $planLength . $item['plan']['recurringPeriodUnit'] ?></span>
                    <?php endif; ?>
                    <a href="<?= url('create-account', ['planId' => $item['planId']]) ?>" class="ui brand color button">Select Plan</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
