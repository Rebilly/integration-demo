@section('title', 'Sign Up - ' . $planId)
@section('content')
<!-- Account -->
<div class="ui centered container account stackable grid">
    <div class="row">
        <div class="center aligned column">
            <div class="ui huge centered header">Sign up now!</div>
            <div class="ui hidden divider"></div>
        </div>
    </div>
    <div class="row">
        <div class="eleven wide tablet eight wide computer column">
            <div class="create">
                <h4 class="ui center aligned top attached inverted brand color header title">
                    CREATE YOUR ACCOUNT
                </h4>
                <div class="ui bottom attached segment info">
                    <?php if(isset($errors)): ?>
                    <div class="ui error message">
                        <strong>Please check the following errors:</strong>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                    <?php endif ?>
                    <p>Please fill out all of the following fields to create an account:</p>
                    <form class="ui form" method="post" action="<?= url('create-account', ['planId' => $planId]) ?>">
                        <div class="fields">
                            <div class="eight wide field required">
                                <label>First Name</label>
                                <input type="text" name="Customer[firstName]" placeholder="John">
                            </div>
                            <div class="eight wide field required">
                                <label>Last Name</label>
                                <input type="text" name="Customer[lastName]" placeholder="Doe">
                            </div>
                        </div>
                        <div class="field required">
                            <label>Email</label>
                            <input type="text" name="Customer[email]" placeholder="johndoe@email.com">
                        </div>
                        <div class="field required">
                            <label>Password</label>
                            <input type="password" name="Credential[password]" placeholder="">
                        </div>
                        <div class="field required">
                            <label>Confirm Password</label>
                            <input type="password" name="Credential[confirmPassword]" placeholder="">
                        </div>
                        <div class="field">
                            <label>Company Name</label>
                            <input type="text" name="Customer[customFields][company]" placeholder="Company Name">
                        </div>
                        <div class="field">
                            <label>Position</label>
                            <input type="text" name="Customer[customFields][position]" placeholder="Position">
                        </div>
                        <div class="field">
                            <label>Industry</label>
                            <?= view('partial.industry', ['fieldName' => 'Customer[customFields][industry]', 'selectedValue' => null]) ?>
                        </div>
                        <div class="field">
                            <label>Phone</label>
                            <input type="text" name="Customer[customFields][phone]" placeholder="">
                        </div>
                        <div class="field">
                            <label>Country</label>
                            <?= view('partial.country', ['fieldName' => 'Customer[customFields][country]', 'selectedValue' => null]) ?>
                        </div>
                        <button class="ui fluid brand secondary color button" type="submit">Join Now</button>
                        <small class="legal">By clicking Join now, you accept our <a href="#">Privacy Policy</a> and <a href="#">Terms of Use</a>.</small>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
