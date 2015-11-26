@section('layoutType', 'login')
@section('title', 'Login')
@section('content')

<div class="ui middle aligned center aligned grid">
    <div class="login column">
        <h3 class="ui header title color brand">
            Log-in to your account
        </h3>
        <div class="ui segment login">
            <form class="ui form" method="post">
                <div class="field">
                    <input type="text" name="Login[username]" placeholder="E-mail address">
                </div>
                <div class="field">
                    <input type="password" name="Login[password]" placeholder="Password">
                </div>
                <div class="field remember">
                    <div class="ui checkbox">
                        <input type="checkbox" tabindex="0" class="hidden">
                        <label>Remember me</label>
                    </div>
                </div>
                <button class="ui fluid brand secondary color button" type="submit">Login</button>
            </form>
        </div>
        @if(isset($errors))
            <div class="ui error message">
                <strong>Please check the following errors:</strong>
                <ul>
                    @foreach($errors as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="ui message">
            <a href="<?= url('/forgot-password') ?>">Forgot your password?</a>&nbsp;&nbsp;&nbsp;&nbsp;New to us? <a href="<?= url('/') ?>">Sign Up</a>
        </div>
        <small>Copyright&copy; All rights reserved.</small>
    </div>
</div>
@endsection
