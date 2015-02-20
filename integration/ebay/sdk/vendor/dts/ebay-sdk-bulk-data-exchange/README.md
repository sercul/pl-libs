# EBAY-SDK-BULK-DATA-EXCHANGE

[![Build Status](https://travis-ci.org/davidtsadler/ebay-sdk-bulk-data-exchange.svg?branch=develop)](https://travis-ci.org/davidtsadler/ebay-sdk-bulk-data-exchange)

This project enables PHP developers to use the [eBay API](https://go.developer.ebay.com/developers/ebay/documentation-tools/) in their PHP code, and build software using the [Bulk Data Exchange](https://developer.ebay.com/DevZone/large-merchant-services/Concepts/LMS_APIGuide.html#bdxservice) service. You can get started by [installing the SDK via Composer](http://devbay.net/sdk/guides/installation/) and by following the [Getting Started Guide](http://devbay.net/sdk/guides/getting-started/).

## Features

  - Compatible with PHP 5.3.9 or greater.
  - Easy to install with [Composer](http://getcomposer.org/).
  - Compliant with [PSR-0](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md), [PSR-1](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md) and [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md).

## Resources

  - [User Guides](http://devbay.net/sdk/guides/) - Getting started guide and in-depth information.
  - [SDK Versions](http://devbay.net/sdk/guides/versions/) - A complete list of each SDK, and the API version they support.
  - [Sample Project](https://github.com/davidtsadler/ebay-sdk-examples) - Provides several examples of using the SDK.
  - [Google Group](https://groups.google.com/forum/#!forum/ebay-sdk-php) - Join for support with the SDK.
  - [@devbaydotnet](https://twitter.com/devbaydotnet) - Follow on Twitter for announcements of releases, important changes and so on.

## Requirements

  - PHP 5.3.3 or greater with the following extensions:
      - cURL
      - libxml
  - 64 bit version of PHP recommended as there are some [issues when using the SDK with 32 bit](http://devbay.net/sdk/guides/requirements/#issues).
  - SSL enabled on the cURL extension so that https requests can be made.

## Installation

This package can be installed with [Composer](http://getcomposer.org/).

  1. Add `dts/ebay-sdk-bulk-data-exchange` as a dependency in your project's composer.json file.

     ```javascript
     {
         "require": {
             "dts/ebay-sdk-bulk-data-exchange": "~0.1"
         }
     }
     ```

  1. Install Composer.

     ```
     curl -sS https://getcomposer.org/installer | php
     ```

  1. Install the dependencies.

     ```
     php composer.phar install
     ```

  1. Require Composer's autoloader by adding the following line to your code.

     ```php
     require 'vendor/autoload.php';
     ```

## Example

### List all jobs

```php
<?php

require 'vendor/autoload.php';

use \DTS\eBaySDK\BulkDataExchange\Services;
use \DTS\eBaySDK\BulkDataExchange\Types;

// Instantiate an eBay service.
$service = new Services\BulkDataExchangeService(array(
    'authToken' => 'YOUR_PRODUCTION_USER_TOKEN_APPLICATION_KEY'
));

// Create the API request object.
$request = new Types\GetJobsRequest();

// Send the request.
$response = $service->getJobs($request);

// Output the response from the API.
foreach($response->jobProfile as $jobProfile) {
    printf("(%s) %s [%s]\n",
        $jobProfile->jobId,
        $jobProfile->jobType,
        $jobProfile->jobStatus
    );
}
```

## Project Goals

  - Be well maintained.
  - Be [well documented](http://devbay.net/sdk/guides/).
  - Be [well tested](https://github.com/davidtsadler/ebay-sdk-bulk-data-exchange/tree/master/test/DTS/eBaySDK/BulkDataExchange).
  - Be well supported with [working examples](https://github.com/davidtsadler/ebay-sdk-examples/blob/master/bulk-data-exchange/README.md).

## Project Maturity

This is a personal project that has been developed by me, [David T. Sadler](http://twitter.com/davidtsadler). I decided to create this project to make up for the lack of an official SDK for PHP. It is in no way endorsed, sponsored or maintained by eBay.

As this is a brand new project you should expect frequent releases until it reaches the stable `1.0.0` target. I will endeavour to keep changes to a minimum between each release and any changes will be [documented](https://github.com/davidtsadler/ebay-sdk-bulk-data-exchange/blob/master/CHANGELOG.md).

## License

Licensed under the [Apache Public License 2.0](http://www.apache.org/licenses/LICENSE-2.0.html).

Copyright 2014 [David T. Sadler](http://twitter.com/davidtsadler)
