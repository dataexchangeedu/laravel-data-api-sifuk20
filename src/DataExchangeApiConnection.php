<?php

namespace DataExchange\Laravel\SIFUK20;

use DataExchange\SIFUK20\Configuration;
use DataExchange\SIFUK20\DataExchangeApi as DXApi;
use Exception;

class DataExchangeApiConnection
{
    protected $api;
    protected $zoneId;
    protected $vars;
    protected $mths;

    public function __construct($connection = null)
    {
        $this->vars = array_keys(get_class_vars(DataExchangeApi::class));
        $this->mths = array_keys(get_class_methods(DataExchangeApi::class));

        if (is_null($connection) || $connection == 'default') {
            $connection = config('dataexchange-data-api.default');
        }

        $config = array_merge([
            'zone_id' => '',
            'url' => null,
            'token' => '',
        ], config("dataexchange-data-api.connections.{$connection}", []));

        Configuration::getDefaultConfiguration()->setApiKey('Authorization', $config['token']);
        Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

        $this->api = new DXApi();

        if ($config['url']) {
            $client = $this->api->getApiClient();
            $client->getConfig()->setHost($config['url']);
        }

        $this->zoneId = $config['zone_id'];
    }

    public function getApiInstance()
    {
        return $this->api;
    }

    public function getZoneId()
    {
        return $this->zoneId;
    }

    public function __call($method, $arguments)
    {
        if (in_array($method, $this->mths)) {
            return call_user_func_array([ $this->api, $method ], array_merge([
                $this->zoneId
            ], $arguments));
        } else {
            throw new Exception("Cannot call {$method}, it doesn't exist or is not visible");
        }
    }

    public function __get($name)
    {
        if (in_array($name, $this->vars)) {
            return $this->api->{$name};
        } else {
            throw new Exception("Cannot get {$name}, it doesn't exist or is not visible");
        }
    }

    public function __set($name, $value)
    {
        if (in_array($name, $this->vars)) {
            $this->api->{$name} = $value;
        } else {
            throw new Exception("Cannot set {$name}, it doesn't exist or is not visible");
        }
    }
}
