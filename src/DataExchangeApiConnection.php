<?php

namespace DataExchange\Laravel\SIFUK20;

use DataExchange\SIFUK20\Configuration;
use DataExchange\SIFUK20\Api\DataExchangeApi;
use Exception;
use Log;

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
            $connection = config('dataexchange-data-api.default.connection');
        }

        $config = array_merge([
            'zone_id' => '',
            'url' => config('dataexchange-data-api.default.url', null),
            'token' => config('dataexchange-data-api.default.token'),
        ], config("dataexchange-data-api.connections.{$connection}", []));

        $this->api = new DataExchangeApi();
        $apiConfig = $this->api->getConfig();
        $apiConfig->setApiKey('Authorization', $config['token']);
        $apiConfig->setApiKeyPrefix('Authorization', 'Bearer');
        $apiConfig->setUserAgent($apiConfig->getUserAgent() . '/Laravel');
        if ($config['url']) {
            $apiConfig->setHost($config['url']);
        }
        $apiConfig->setDebug(config('dataexchange-data-api.debug'));

        if($apiConfig->getDebug()) {
            Log::info($this->getDebugReport());
        }

        $this->zoneId = $config['zone_id'];
    }

    public function getDebugReport()
    {
        $apiConfig = $this->api->getConfig();

        // Prevent the whole API key from ending up int he log...
        $auth = $apiConfig->getApiKeyWithPrefix('Authorization');
        $len = strlen($auth);
        $show = strpos($auth, ' ') + 5;
        $auth = str_pad(substr_replace($auth, '*', $show), $len, '*');

        $report = $apiConfig->toDebugReport();
        $report .= '    Headers:' . PHP_EOL;
        $report .= '        Authorization' . $auth . PHP_EOL;
        $report .= '        User-Agent: ' . $apiConfig->getUserAgent() . PHP_EOL;
        $report .= '        Host' . $apiConfig->getHost() . PHP_EOL;

        return $report;
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
