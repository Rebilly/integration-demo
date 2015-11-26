@section('layoutType', 'user')
@section('title', 'Forgot Password')
@section('content')

<div class="ui stackable grid centered container user" xmlns="http://www.w3.org/1999/html">
    <div class="nine wide column">
        <h2 class="ui header title color brand">Change password</h2>
        <div class="ui segment management">
            <div class="section">
                <?php if (isset($errors)): ?>
                <div class="ui error message">
                    <strong>Please check the following errors:</strong>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                        <li><?= $error ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
                <div class="ui hidden divider"></div>
                <?php endif ?>
            </div>
            <form class="ui form" id="ChangePassword" method="post">
                <div class="field">
                    <label>Enter your password</label>
                    <input type="password" name="Password[old]">
                </div>
                <div class="field">
                    <label>Enter your new password</label>
                    <input type="password" name="Password[new]">
                </div>
                <div class="field">
                    <label>Enter your confirm password</label>
                    <input type="password" name="Password[confirm]">
                </div>
                <div class="ui hidden divider"></div>
                <div class="ui divider"></div>
                <div class="actions">
                    <a href="<?= url('/profile') ?>" class="ui negative cancel button">Cancel</a>
                    <button class="ui positive approve button" type="submit">Save</button>
                </div>
            </form>
        </div>
        <div class="ui tiny grey center aligned header footer">
            Copyright&copy; All rights reserved.
        </div>
    </div>
</div>
@endsection
