<?php
namespace ZiNETHQ\DataExchange\Data\Api\SifUk20;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

use Carbon\Carbon;

use ZiNETHQ\DataExchange\Data\Api\SifUk20\DataExchangeDataApi;

class DataExchangeDataApiServiceProvider extends ServiceProvider
{
    /**
     * Indicates of loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    protected $commands = [];

    /**
     * Boot the service provider
     *
     * @return null
     */
    public function boot()
    {
        $this->publish();
    }

    /**
     * Register the service provider
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../install-stubs/config/dataexchange-data-api.php',
            'dataexchange-data-api'
        );

        $this->app->singleton(DataExchangeDataApi::class, function ($app) {
            return new DataExchangeDataApi();
        });

        $this->commands($this->commands);
    }

    /**
     * Construct the array of files to publish
     *
     * @return void
     */
    protected function publish()
    {
        $this->publishes([
            __DIR__.'/../install-stubs/config' => config_path()
        ]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [DataExchangeDataApi::class];
    }
}
