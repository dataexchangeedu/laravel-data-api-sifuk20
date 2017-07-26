<?php

namespace DataExchange\Data\Api\SifUk20;

use DataExchange\SIFUK20\Configuration;
use DataExchange\SIFUK20\DataExchangeApi;

class DataExchangeDataApi
{
    protected $api;

    public function __construct()
    {
        Configuration::getDefaultConfiguration()->setApiKey('Authorization', config('dataexchange-data-api.token'));
        Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

        $this->api = new DataExchangeApi();

        $url = config('dataexchange-data-api.url');
        if ($url) {
            $client = $this->api->getApiClient();
            $config = $client->getConfig();
            $config->setHost($url);
        }
    }

    public function getApiInstance()
    {
        return $this->api;
    }

    public function __call($method, $arguments)
    {
        return call_user_func_array([ $this->api, $method ], $arguments);
    }
}
