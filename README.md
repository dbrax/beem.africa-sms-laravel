# Beem Africa Sms PHP Package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/epmnzava/bongolivesms-laravel.svg?style=flat-square)](https://packagist.org/packages/epmnzava/bongolivesms-laravel)
[![Total Downloads](https://img.shields.io/packagist/dt/epmnzava/bongolivesms-laravel.svg?style=flat-square)](https://packagist.org/packages/epmnzava/bongolivesms-laravel)
[![Emmanuel Mnzava](https://img.shields.io/badge/Author-Emmanuel%20Mnzava-green)](mailto:epmnzava@gmail.com)




## Installation

- Laravel Version: => 8.0 
- PHP Version: => 8.0
You can install the package via composer:

```bash
composer require epmnzava/bongolivesms-laravel
```

# Update your config (for Laravel 5.4 and below)
Add the service provider to the providers array in config/app.php:
```
Epmnzava\BongolivesmsLaravel\BongolivesmsLaravelServiceProvider::class,
```
Add the facade to the aliases array in config/app.php:
```
'Bongolive'=>Epmnzava\BongolivesmsLaravel\BongolivesmsLaravelFacade::class,
```




# Publish the package configuration (for Laravel 5.4 and below)
Publish the configuration file and migrations by running the provided console command:
```
php artisan vendor:publish --provider="Epmnzava\BongolivesmsLaravel\BongolivesmsLaravelServiceProvider"
```
### Environmental Variables

BEEM_LIVE_KEY `your provided beemafrica api key `

BEEM_LIVE_SECRET ` your provided beemafrica secret`

BEEM_SENDERID ` your provided beemafrica senderid`

## Usage

``` php

Sending to one msisdn at a time 

<?php
use Bongolive;

class DashboardController extends Controller
{
    //


    public function runSms(){

//assuming $recipient_msisdn is your receipient number 
//we need to change it from 0XXXX to 255XXX

if(substr($recipient_msisdn, 0, 1)==0){
  $msisdn = ltrim($recipient_msisdn, "0");

  $recipient_msisdn="255"."".$msisdn;


}else{}
        $response=Bongolive::send__single_recipient($source_addr,$message,$recipient_msisdn);

    }


Sending multiple msisdn at one by passing an array of numbers

<?php
use Bongolive;

class DashboardController extends Controller
{
    //


    public function runSms(){

//assuming $recipient_msisdn is your receipient number 
//we need to change it from 0XXXX to 255XXX

 
 $recipient_array=["255679079774","2556789909"];
        $response=Bongolive::send__multiple_recipient($source_addr,$message,$recipient_array);

    }


```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email epmnzava@gmail.com instead of using the issue tracker.

## Credits

- [Emmanuel Mnzava](https://github.com/dbrax)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

