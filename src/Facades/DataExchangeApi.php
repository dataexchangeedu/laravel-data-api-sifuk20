<?php
namespace DataExchange\Laravel\SIFUK20\Facades;

use Illuminate\Support\Facades\Facade;
use DataExchange\Laravel\SIFUK20\DataExchangeApi as DXApi;

class DataExchangeApi extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return DXApi::class;
    }
}
