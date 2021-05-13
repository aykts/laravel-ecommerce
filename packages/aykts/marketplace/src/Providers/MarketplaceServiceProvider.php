<?php

namespace Aykts\Marketplace\Providers;

use Aykts\Marketplace\Controllers\Trendyol\TrendyolClient;
use Aykts\Marketplace\Controllers\Trendyol\TrendyolService;
use Illuminate\Support\ServiceProvider;

class MarketplaceServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->singleton('Trendyol', function () {
            $trendyolClient = new  TrendyolClient();
            $trendyolClient->setSupplierId(env('TRENDYOL_SUPPLIER_ID'));
            $trendyolClient->setApiKey(env('TRENDYOL_API_KEY'));
            $trendyolClient->setApiSecretKey(env('TRENDYOL_SECRET_KEY'));

            return new TrendyolService($trendyolClient);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}
