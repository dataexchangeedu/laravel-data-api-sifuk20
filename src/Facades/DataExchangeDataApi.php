<?php
namespace ZiNETHQ\DataExchange\Data\Api\SifUk20\Facades;

use Illuminate\Support\Facades\Facade;
use ZiNETHQ\DataExchange\Data\Api\SifUk20\DataExchangeDataApi as DXDataApi;

class DataExchangeDataApi extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return DXDataApi::class;
    }
}
