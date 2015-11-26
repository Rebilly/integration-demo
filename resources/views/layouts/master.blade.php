<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Your Demo Application - @yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->
    <link href="<?= url('assets/css/semantic.min.css') ?>" rel="stylesheet">
    <link href="<?= url('assets/css/main.css') ?>" rel="stylesheet">
    <script src="<?= url('assets/js/vendor/modernizr-2.8.3.min.js') ?>"></script>
</head>
<body class="@yield('layoutType')">
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<!-- Header -->
<div class="ui brand color attached top borderless inverted menu">
    <div class="ui container">
        <div class="item">
            Your Logo goes here
        </div>
        <?php if (isset($_SESSION['token'])): ?>
        <div class="right menu">
            <div class="ui dropdown item">
                <i class="user icon"></i>
                <i class="caret down icon"></i>
                <div class="menu">
                    <a href="<?= url('/logout') ?>" class="item">Log out</a>
                </div>
            </div>
        </div>
        <?php endif ?>
    </div>
</div>
@yield('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.3.min.js"><\/script>')</script>
<script src="<?= url('assets/js/semantic.min.js') ?>"></script>
<script src="<?= url('assets/js/main.js') ?>"></script>
@yield('extraScript')
</body>
</html>
