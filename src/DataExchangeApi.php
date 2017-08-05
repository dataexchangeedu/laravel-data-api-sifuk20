<?php

namespace DataExchange\Laravel\SIFUK20;

use DataExchange\SIFUK20\Configuration;
use DataExchange\SIFUK20\DataExchangeApiConnection as Connection;

class DataExchangeApi
{
    const DEFAULT_CONNECTION = 'default';
    protected $connections = [];

    public function on($connection)
    {
        if (!isset($this->connections[$connection])) {
            $this->connections[$connection] = new Connection($connection);
        }

        return $this->connections[$connection];
    }

    public function __call($method, $arguments)
    {
        return call_user_func_array([ $this->on(self::DEFAULT_CONNECTION), $method ], $arguments);
    }

    public function __get($name)
    {
        return $this->on(self::DEFAULT_CONNECTION)->{$name};
    }

    public function __set($name, $value)
    {
        $this->on(self::DEFAULT_CONNECTION)->{$name} = $value;
    }
}
