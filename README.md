SKRIME PHP API Client
=======================

[![Latest Version](https://img.shields.io/packagist/v/skrime/skrime-php-sdk?label=version)](https://packagist.org/packages/skrime/skrime-php-sdk/)
[![Composer Downloads](https://img.shields.io/packagist/dm/skrime/skrime-php-sdk.svg?label=Composer%20Downloads)](https://packagist.org/packages/skrime/skrime-php-sdk)


This **PHP 7.0+** library allows you to communicate with the SKRIME API.

## Getting Started

Recommended installation is using **Composer**!

In the root of your project execute the following:
```sh
$ composer require skrime/skrime-php-sdk
```
 
Or add this to your `composer.json` file:
```json 
{
    "require": {
        "skrime/skrime-php-sdk": "^1.0"
    }
}
```

Then perform the installation:
```sh
$ composer install --no-dev
```

### Examples

Get Domain Pricelist
```php
<?php
// Require the autoloader
require_once 'vendor/autoload.php';

// Use the library namespace
use SKRIME/API;

// Then simply pass your API-Token when creating the API client object.
$client = new API('API-Token');

// Then you are able to perform a request
var_dump($client->domain()->getPricelist());
?>
```