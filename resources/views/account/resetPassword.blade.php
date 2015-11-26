@section('layoutType', 'login')
@section('title', 'Reset Password')
@section('content')

<div class="ui middle aligned center aligned grid">
    <div class="login column">
        <h3 class="ui header title color brand">
            Reset your password?
        </h3>
        <div class="ui segment login">
            <form class="ui form" method="post">
                <div class="field">
                    <input type="password" name="password" placeholder="New Password">
                </div>
                    <div class="field">
                        <input type="password" name="confirmPassword" placeholder="Confirm Password">
                    </div>
                <button class="ui fluid large brand secondary color submit button" type="submit">Submit</button>
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
