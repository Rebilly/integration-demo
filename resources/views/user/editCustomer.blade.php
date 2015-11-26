@section('layoutType', 'user')
@section('title', 'Edit User Profile')
@section('content')

<div class="ui stackable grid centered container user">
    <div class="nine wide column">
        <h2 class="ui header title color brand">Edit contact info</h2>
        <div class="ui segment management">
            <div class="section">
            <?php if(isset($errors)):?>
                <div class="ui error message">
                    <strong>Please check the following:</strong>
                    <ul>
                        <?php foreach($errors as $error):?>
                        <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="ui hidden divider"></div>
                <?php endif; ?>
            </div>
            <form class="ui form" id="contact-form" method="post">
                <div class="fields">
                    <div class="eight wide field">
                        <label>First Name</label>
                        <input type="text" name="Customer[firstName]" value="<?= $customer->getFirstName() ?>">
                    </div>
                    <div class="eight wide field">
                        <label>Last Name</label>
                        <input type="text" name="Customer[lastName]" value="<?= $customer->getLastName() ?>">
                    </div>
                </div>
                <div class="field">
                    <label>Email Address</label>
                    <div class="ui disabled input">
                        <input type="text" name="Customer[email]" value="<?= $customer->getEmail() ?>">
                    </div>
                </div>
                <div class="field">
                    <label>Company</label>
                    <input type="text" name="Customer[customFields][company]" value="<?= isset($customer->getCustomFields()['company']) ? $customer->getCustomFields()['company'] : '' ?>">
                </div>
                <div class="field">
                    <label>Position</label>
                    <input type="text" name="Customer[customFields][position]" value="<?= isset($customer->getCustomFields()['position']) ? $customer->getCustomFields()['position'] : '' ?>">
                </div>
                <div class="field">
                    <label>Industry</label>
                    <?= view('partial.industry', ['fieldName' => 'Customer[customFields][industry]', 'selectedValue' => isset($customer->getCustomFields()['industry']) ? $customer->getCustomFields()['industry'] : '' ] ) ?>
                </div>
                <div class="field">
                    <label>Phone</label>
                    <input type="text" name="Customer[customFields][phone]" value="<?= isset($customer->getCustomFields()['phone']) ? $customer->getCustomFields()['phone'] : '' ?>">
                </div>
                <div class="field">
                    <label>Country</label>
                    <?= view('partial.country', ['fieldName' => 'Customer[customFields][country]', 'selectedValue' => isset($customer->getCustomFields()['country']) ? $customer->getCustomFields()['country'] : null]) ?>
                </div>
                <div class="ui hidden divider"></div>
                <div class="ui divider"></div>
                <div class="actions">
                    <button class="ui negative cancel button" href="<?= url('/profile') ?>">Cancel</button>
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
