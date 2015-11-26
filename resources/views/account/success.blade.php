@section('title', 'Billing')
@section('content')
<div class="ui centered container account stackable grid">
    <div class="row">
        <div class="center aligned column">
            <div class="ui huge centered header">Thanks for your Purchase!</div>
            <h2 class="ui large centered grey header">We appreciate your business. We are provisioning your account,<br>so you can proceed to our website.</h2>
            <div class="ui hidden divider"></div>
        </div>
    </div>
    <div class="row">
        <div class="ten wide column">
            <div class="confirmation">
                <h4 class="ui center aligned top attached inverted brand color header title">
                    PURCHASE CONFIRMATION
                </h4>
                <div class="ui attached segment">
                    <div class="ui stackable container grid">
                        <div class="row">
                            <div class="eight wide column">
                                <h5><?= $website->getName() ?></h5>
                                <?= $website->getUrl() ?>
                            </div>
                            <div class="eight wide right aligned column">
                                <h5>Billed to:</h5>
                                <?= $customer->getFirstName() . ' ' . $customer->getLastName() ?><br>
                                <?= $customer->getEmail() ?><br><br>
                                <?= date('Y-m-d', strtotime($invoice->getDueTime())) ?><br>
                                <?= $customer->getDefaultCard()->getBrand() . ' **** **** **** ' . $customer->getDefaultCard()->getLast4() ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="sixteen wide column">
                                <div class="ui hidden divider"></div>
                                <table class="ui very basic compact table">
                                    <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th class="right aligned">Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <strong><?= $subscription->getPlan()->getName() ?></strong><br>
                                            <?= $subscription->getPlan()->getDescription() ?>
                                        </td>
                                        <td class="right aligned">
                                            <?= $subscription->getPlan()->getCurrencySign() . $invoice->getAmount() ?>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr><th colspan="2">
                                            <div class="right aligned">
                                                <h4>Total: <?= $subscription->getPlan()->getCurrencySign() . $invoice->getAmount() ?></h4>
                                            </div>
                                        </th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ui bottom attached center aligned segment">
                    <a href="<?= url('/profile') ?>" class="ui button secondary brand color no-top">Continue to profile</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
