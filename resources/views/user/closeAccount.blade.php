@section('layoutType', 'user')
@section('title', 'Forgot Password')
@section('content')

<div class="ui stackable grid centered container user">
    <div class="nine wide column">
        <h2 class="ui header title color brand">Close Account</h2>
        <div class="ui segment management">
            <form method="post" name="Account">
            <div class="section">
            </div>
            <h4 class="no-top">Are you sure you want to close your account? Please tell us why.</h4>
            <div class="ui hidden divider"></div>
            <div class="ui form">
                <div class="grouped fields withOther">
                    <div class="field">
                        <div class="ui radio checkbox">
                            <input type="radio" name="Customer[reason]" checked="checked" value="I found a better product somewhere else.">
                            <label>I found a better product somewhere else.</label>
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui radio checkbox">
                            <input type="radio" name="Customer[reason]" value="I'm not interested in the product anymore.">
                            <label>I'm not interested in the product anymore.</label>
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui radio checkbox">
                            <input type="radio" name="Customer[reason]" value="I don't need the product anymore">
                            <label>I don't need the product anymore</label>
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui radio other checkbox">
                            <input type="radio" name="Customer[reason]" value="Other">
                            <label>Other:</label>
                        </div>
                        <div class="why disabled field">
                            <textarea rows="2" name="Customer[other]"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ui hidden divider"></div>
            <div class="ui divider"></div>
            <div class="actions">
                <a href="<?= url('/profile') ?>" class="ui negative cancel button">Cancel</a>
                <button type="submit" class="ui button">Goodbye</button>
            </div>
            </form>
        </div>
        <div class="ui tiny grey center aligned header footer">
            Copyright&copy; All rights reserved.
        </div>
    </div>
</div>
@endsection;
