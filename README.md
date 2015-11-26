Rebilly Integration Demo
========================

[https://rebillydemo.com](https://rebillydemo.com)

A Rebilly integration demo that uses the [PHP SDK](https://github.com/rebilly/rebilly-php) and [Lumen Micro Framework](http://lumen.laravel.com/).  As the name implies, it is for demonstration purposes, and may be ported to any framework or application.

### Usage
Please see the [API Documentation](https://www.rebilly.com/sandbox/api/documentation/v2.1/) and [Javascript client Documentation](https://www.rebilly.com/sandbox/api/jsdoc/)

### Getting started
+ Download and install [vagrant](https://www.vagrantup.com/downloads.html).

+ Download and install [virtualbox](https://www.virtualbox.org/wiki/Downloads).

+ Clone this repository.
```
git clone https://github.com/rebilly/integration-demo.git
```

+ Go to your cloned folder and start your development environment
```
vagrant up
```
The Vagrantfile uses this [base box](https://github.com/rlerdorf/php7dev) which comes with 26 versions of PHP including PHP 7 and 7.1.  Although, any environment with PHP 5.6 and composer should work.

+ SSH to your vagrant VM
```
vagrant ssh
cd /vagrant
```

+ Install composer
```
composer install
```

+ Setup your Rebilly account **(Make sure to use sandbox mode for all your testing)**
 * [Signup for new account](https://www.rebilly.com/site/signup)
 * Create [website(s)](https://www.rebilly.com/sandbox/websites/add/)
 * Create [plan(s)](https://www.rebilly.com/sandbox/plans/add/)
 * Create [layout](https://www.rebilly.com/sandbox/layoutItem/create/)
 * Add new [payment gateway](https://www.rebilly.com/sandbox/paymentProcessors/add/RebillyProcessor)
 * Check your api key and user [here](https://www.rebilly.com/sandbox/api/)

+ In your project root copy `.env.dev` or `.env.prod` to `.env` and adjust the values for the Rebilly environment variables
 * `REBILLY_API_HOST="https://api-sandbox.rebilly.com"`
 * `REBILLY_API_KEY="YOUR API KEY"`
 * `REBILLY_LAYOUT_ID="YOUR LAYOUT ID"`
 * `REBILLY_WEBSITE="YOUR WEBSITE ID"`
 * `REBILLY_JS_URL="https://www.rebilly.com/sandbox/js"`
 * Remember to generate a random 32 character alphanumeric key for `APP_KEY=`

+ Ensure storage path is writable by your web process (eg. `www-data`)

+ Run these commands from your Vagrant VM command line to create custom fields
```
php artisan customField customers company string
php artisan customField customers industry string
php artisan customField customers cancelReason string
php artisan customField customers phone string
php artisan customField customers country string
php artisan customField customers position string
```

+ Go to [http://www.dev-local.rebillydemo.com/](http://www.dev-local.rebillydemo.com/)

### Troubleshooting

+ The Vagrantfile sets the local domain to `www.dev-local.rebillydemo.com`. Make sure you have the [Vagrant hostmanager plugin](https://github.com/smdahlen/vagrant-hostmanager) installed.
+ The web/app server must have proper read/write permissions to the storage directory and sub-directories.

