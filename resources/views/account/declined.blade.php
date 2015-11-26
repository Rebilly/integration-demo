@section('title', 'Billing')
@section('content')
<div class="ui centered container account stackable grid">
    <div class="row">
        <div class="center aligned column">
            <div class="ui huge centered header">Your transaction was declined!</div>
            <h2 class="ui large centered grey header">We were not able to process your billing information. Please verify and try again.</h2>
            <div class="ui hidden divider"></div>
            <a class="ui brand color button" href="<?= url('billing', ['planId' => $planId]) ?>">Verify your billing information</a>
        </div>
    </div>
</div>
@endsection
