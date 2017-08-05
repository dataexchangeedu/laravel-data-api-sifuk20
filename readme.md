# DataExchange SIF UK 2.0 Api for Laravel

[![Laravel 5.3](https://img.shields.io/badge/Laravel-5.3-orange.svg?style=flat-square)](http://laravel.com)
[![Source](http://img.shields.io/badge/source-dataexchangeedu/laravel--data--api--sifuk20-blue.svg?style=flat-square)](https://github.com/dataexchangeedu/laravel-data-api-sifuk20)
[![Build Status](https://travis-ci.org/dataexchangeedu/laravel-data-api-sifuk20.svg?branch=master)](https://travis-ci.org/dataexchangeedu/laravel-data-api-sifuk20)
[![License](http://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](https://tldrlegal.com/license/mit-license)

DataExchangeApi provides a simple Laravel wrapper (facade) around the dataexchangeedu/php-data-api-sifuk20 library for use against DataExchange ([dataexchange.education](https://dataexchange.education)).

## Quick Installation

1. Install the package through Composer.

    ```bash
    composer require dataexchangeedu/laravel-data-api-sifuk20
    ```

1. Add the service provider to your project's `config/app.php` file.

    ```php
    'providers' => [
        ...
        DataExchange\Laravel\SIFUK20\DataExchangeApiServiceProvider::class,
        ...
    ],
    ```

1. Add the Facade to your project `config/app.php` file.

    ```php
    'aliases' => [
        ...
        'DataExchangeApi' => DataExchange\Laravel\SIFUK20\Facades\DataExchangeApi::class,
        ...
    ],
    ```

1. Publish the configuration, models, and migrations into your project.

    ```bash
    php artisan vendor:publish --provider="DataExchange\Laravel\SIFUK20\DataExchangeApiServiceProvider"
    ```

1. Set your connection settings in `config\dataexchange-data-api.php`.

1. Start using it!

    ```PHP
    <?php

    use DataExchangeApi;
    use Exception;

    ...

    try {
        dd(DataExchangeApi::on('default')->getSchoolInfos());
    } catch (Exception $ex) {
        dd($ex);
    }

    ...
    ```

    Different ways to call the same thing (assuming `ZONEID` is in connection `school`, which is the default connection):
    - `DataExchangeApi::getSchoolInfos(); // Implicitly use the default connection`
    - `DataExchangeApi::on(null)->getSchoolInfos(); // Implicitly use the default connection`
    - `DataExchangeApi::on('default')->getSchoolInfos(); // Explicitly use the default connection`
    - `DataExchangeApi::on('school')->getSchoolInfos(); // Explicitly use the school connection`
    - `DataExchangeApi::getApiInstance()->getSchoolInfos('ZONEID'); // Talk directly using the wrapped API`
