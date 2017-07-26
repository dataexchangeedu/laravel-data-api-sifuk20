# DataExchangeDataApi

[![Laravel 5.3](https://img.shields.io/badge/Laravel-5.3-orange.svg?style=flat-square)](http://laravel.com)
[![Source](http://img.shields.io/badge/source-dataexchangeedu/laravel--php--data--api--sifuk20-blue.svg?style=flat-square)](https://github.com/dataexchangeedu/laravel-php-data-api-sifuk20)
[![Build Status](https://travis-ci.org/dataexchangeedu/laravel-php-data-api-sifuk20.svg?branch=master)](https://travis-ci.org/dataexchangeedu/laravel-php-data-api-sifuk20)
[![License](http://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](https://tldrlegal.com/license/mit-license)

DataExchangeDataApi provides a simple Laravel wrapper (facade) around the dataexchangeedu/php-data-api-sifuk20 library for use against DataExchange ([dataexchange.education](https://dataexchange.education)).

## Quick Installation

1. Install the package through Composer.

    ```bash
    composer require dataexchangeedu/laravel-php-data-api-sifuk20
    ```

1. Add the service provider to your project's `config/app.php` file.

    ```php
    ZiNETHQ\DataExchange\Data\Api\SifUk20\DataExchangeDataApiServiceProvider::class,
    ```

1. Publish the configuration, models, and migrations into your project.

    ```bash
    php artisan vendor:publish --provider="ZiNETHQ\DataExchange\Data\Api\SifUk20\DataExchangeDataApiServiceProvider"
    ```

1. Set your connection settings in `config\dataexchange-data-api.php`.

1. Start using it!

    ```PHP
    <?php

    use DataExchangeDataApi;
    use Exception;

    ...

    try {
        dd(DataExchangeDataApi->getSchoolInfos());
    } catch (Exception $ex) {
        dd($ex);
    }

    ...
    ```
