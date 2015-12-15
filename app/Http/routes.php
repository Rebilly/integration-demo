<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', ['uses' => 'MainController@index']);

$app->get('/create-account/{planId}', 'MainController@createAccount');
$app->post('/create-account/{planId}', 'MainController@createAccount');

$app->get('/billing/{planId}', 'MainController@billing');
$app->post('/billing/{planId}', 'MainController@billing');

$app->get('/success/{subscriptionId}', 'MainController@success');
$app->get('/declined/{planId}', 'MainController@declined');

$app->get('/forgot-password', 'MainController@forgotPassword');
$app->post('/forgot-password', 'MainController@forgotPassword');

$app->get('/reset-password/{token}', 'MainController@resetPassword');
$app->post('/reset-password/{token}', 'MainController@resetPassword');

$app->get('/login', 'UserController@login');
$app->post('/login', 'UserController@login');
$app->get('/logout', 'UserController@logout');

$app->group(['middleware' => 'auth'], function ($app) {
    // all of these will use the auth middleware:
    $app->get('/profile', 'App\Http\Controllers\UserController@profile');

    $app->get('/change-password', 'App\Http\Controllers\UserController@changePassword');
    $app->post('/change-password', 'App\Http\Controllers\UserController@changePassword');

    $app->get('/add-payment-method', 'App\Http\Controllers\UserController@addPaymentMethod');
    $app->post('/add-payment-method', 'App\Http\Controllers\UserController@addPaymentMethod');

    $app->post('/cancel-subscription', 'App\Http\Controllers\UserController@cancelSubscription');

    $app->get('/edit-customer', 'App\Http\Controllers\UserController@editCustomer');
    $app->post('/edit-customer', 'App\Http\Controllers\UserController@editCustomer');

    $app->get('/manage-payment-methods', 'App\Http\Controllers\UserController@paymentMethod');
    $app->post('/manage-payment-methods', 'App\Http\Controllers\UserController@paymentMethod');

    $app->get('/subscriptions', 'App\Http\Controllers\UserController@subscriptions');
    $app->post('/subscriptions', 'App\Http\Controllers\UserController@subscriptions');

    $app->get('/create-subscription', 'App\Http\Controllers\UserController@createSubscription');
    $app->post('/create-subscription', 'App\Http\Controllers\UserController@createSubscription');

    $app->get('/switch-subscription/{subscriptionId}', 'App\Http\Controllers\UserController@switchSubscription');
    $app->post('/switch-subscription/{subscriptionId}', 'App\Http\Controllers\UserController@switchSubscription');

    $app->get('/billing-history', 'App\Http\Controllers\UserController@billingHistory');
    $app->post('/billing-history', 'App\Http\Controllers\UserController@billingHistory');

    $app->get('/cancel-subscription/{subscriptionId}', 'App\Http\Controllers\UserController@cancelSubscription');
    $app->post('/cancel-subscription/{subscriptionId}', 'App\Http\Controllers\UserController@cancelSubscription');

    $app->get('/close-account', 'App\Http\Controllers\UserController@closeAccount');
    $app->post('/close-account', 'App\Http\Controllers\UserController@closeAccount');

    $app->get('/download-invoice/{invoiceId}', 'App\Http\Controllers\UserController@downloadInvoice');
});
