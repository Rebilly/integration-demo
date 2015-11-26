@section('layoutType', 'user')
@section('title', 'Manage your plans')
@section('content')

<div class="ui stackable grid centered container user">
    <div class="thirteen wide column">
        <h2 class="ui header title color brand">Manage Subscriptions</h2>
        <div class="ui segment management">
            <div class="section">
            </div>
            <form class="ui form" method="post">
                <table class="ui very basic compact small table">
                    <thead>
                    <tr>
                        <th class="one wide">Quantity</th>
                        <th class="one wide"></th>
                        <th>Plan</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($subscriptions as $subscription) : ?>
                    <?php if ($subscription->getStatus() !== 'Cancelled'): ?>
                    <tr>
                        <td class="center aligned">
                            <?= $subscription->getQuantity() ?>
                        </td>
                        <td class="center aligned">
                            <strong>X</strong>
                        </td>
                        <td>
                            <strong><?= $subscription->getQuantity() ?> x <?= $subscription->getPlan()->getName() ?> - <?= $subscription->getPlan()->getCurrencySign() . $subscription->getPlan()->getRecurringAmount() . '/' . $subscription->getPlan()->getRecurringPeriodLength() . ' ' . $subscription->getPlan()->getRecurringPeriodUnit() ?></strong>
                            <br>
                            <p><?= $subscription->getPlan()->getDescription() ?></p>
                        </td>
                        <td>
                            <span class="plan-status"><?= $subscription->getStatus() ?></span>
                        </td>
                        <?php if($subscription->getStatus() === 'Active'): ?>
                        <td class="right aligned">
                            <a class="changePlan" href="<?= url('/switch-subscription', ['subscriptionId' => $subscription->getId()]) ?>">Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;
                            <a class="removePlan" href="<?= url('/cancel-subscription', ['subscriptionId' => $subscription->getId()]) ?>">Cancel</a>
                        </td>
                        <?php endif ?>
                    </tr>
                    <?php endif ?>
                    <?php endforeach ?>
                    </tbody>
                </table>
                    <div class="ui hidden divider"></div>
                    <a class="ui brand color mini button addPlan no-top" href="<?= url('/create-subscription') ?>"><i class="icon plus"></i>Add a new subscription</a>
                <div class="ui hidden divider"></div>
                <div class="ui divider"></div>
                <div class="actions">
                    <a class="ui button" href="<?= url('/profile') ?>">Go Back</a>
                </div>
            </form>
        </div>
        <div class="ui tiny grey center aligned header footer">
            Copyright&copy; All rights reserved.
        </div>
    </div>
</div>
@endsection
