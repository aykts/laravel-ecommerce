<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * API Version
     *
     * */
    protected $version = '';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *ww
     * @var string|null
     */
    protected $namespace = 'App\\Http\\Controllers';

    /**
     * RouteServiceProvider constructor.
     * @param \Illuminate\Contracts\Foundation\Application $app
     */
    public function __construct(\Illuminate\Contracts\Foundation\Application $app)
    {
        parent::__construct($app);

        /* get url api version */
        $get_version = Request()->segment(2);

        $this->version = (!is_null($get_version) and (File::exists(app_path('Http/Controllers/' . $get_version)))) ?
            $get_version : config('app.api.version');

        $this->namespace = $this->namespace."\\".$this->version;
    }

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->apiRoutes();
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }

    /**
     * Set routes
     */
    protected function apiRoutes()
    {
        $this->routes(function () {
            $api_prefix_path = sprintf("api/%s", $this->version);
            $api_group_path = sprintf(base_path("routes/%s/api.php"), $this->version);

            Route::prefix($api_prefix_path)
                ->middleware('api')
                ->namespace($this->namespace)
                ->group($api_group_path);
        });
    }
}
