@section('layoutType', 'user')
@section('title', 'Transactions: ' . $customerId)
@section('content')

<div class="ui stackable grid centered container user" xmlns="http://www.w3.org/1999/html">
    <div class="eleven wide column">
        <h2 class="ui header title color brand">Billing history</h2>
        <div class="ui segment management">
            <table class="ui very basic compact table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($invoices as $invoice): ?>
                <tr>
                    <td><a href="<?= url('download-invoice', ['invoiceId' => $invoice->getId()]) ?>" target="_blank"> <?= $invoice->getId() ?></a></td>
                    <td><?= date('Y-m-d', strtotime($invoice->getDueTime())) ?></td>
                    <td><?= $invoice->getCurrency() . ' ' . $invoice->getAmount() ?></td>
                </tr>
                <?php endforeach ?>
                </tbody>
            </table>
            <div class="ui hidden divider"></div>
            <div class="ui divider"></div>
            <a href="<?= url('/profile') ?>" class="ui cancel button">Go back</a>
        </div>
        <div class="ui tiny grey center aligned header footer">
            Copyright&copy; All rights reserved.
        </div>
    </div>
</div>
@endsection
