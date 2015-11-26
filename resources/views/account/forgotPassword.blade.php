@section('layoutType', 'login')
@section('title', 'Forgot Password')
@section('content')

<div class="ui middle aligned center aligned grid">
    <div class="login column">
        <h3 class="ui header title color brand">
            Forgot your password?
        </h3>
        <div class="ui segment login">
            <form class="ui form" method="post">
                <p>Please fill out your email address.<br>A link to reset your password will be sent to you.</p>
                <div class="field">
                    <input type="text" name="Customer[username]" placeholder="E-mail address">
                </div>
                <button class="ui fluid large brand secondary color submit button" type="submit">Send</button>
            </form>
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
        <?php if (isset($message)): ?>
        <div class="ui success message">
            <?= $message ?>
        </div>
        <?php endif ?>
        <small>Copyright&copy; All rights reserved.</small>
    </div>
</div>
@endsection
