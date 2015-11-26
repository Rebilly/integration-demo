<?php
/**
* @var $customer \Rebilly\Entities\Customer
 */
?>

<div class="ui small modal contactModal">
    <div class="header brand color">Edit Contact Info</div>
    <div class="content">
        <div class="ui error message hidden">
            <strong>Please check the following:</strong>
            <ul></ul>
        </div>
        <form class="ui form" id="contact-form" method="post" action="<?= url('/update-profile') ?>">
            <input type="hidden" name="customerId" value="<?= $customer->getId() ?>">
            <div class="fields">
                <div class="eight wide field">
                    <label>First Name</label>
                    <input type="text" name="firstName" value="<?= $customer->getFirstName() ?>">
                </div>
                <div class="eight wide field">
                    <label>Last Name</label>
                    <input type="text" name="lastName" value="<?= $customer->getLastName() ?>">
                </div>
            </div>
            <div class="field">
                <label>Email Address</label>
                <input type="text" name="email" value="<?= $customer->getEmail() ?>">
            </div>
        </form>
    </div>
    <div class="actions">
        <div class="ui negative cancel button">Cancel</div>
        <div class="ui positive approve button save-modal" data-form="contact-form">Save</div>
    </div>
</div>
