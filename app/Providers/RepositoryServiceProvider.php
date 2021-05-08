<?php

namespace App\Providers;

use App\Contracts\BaseInterface;
use App\Contracts\CatalogInterface;
use App\Http\Repositories\Eloquent\BaseRepository;
use App\Http\Repositories\Eloquent\CatalogRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BaseInterface::class, BaseRepository::class);
        $this->app->bind(CatalogInterface::class, CatalogRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
