<?php
namespace StevenHardyDigital\LaravelWdMyCloudApi;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class LaravelWdMyCloudApiServiceProvider extends ServiceProvider
{
    /**
    * Publishes configuration file.
    *
    * @return  void
    */
    public function boot()
    {
        $this->handleConfig();
        $this->handleRoutes();
        $this->handleViews();
        $this->handlePublishing();
    }
    /**
    * Make config publishment optional by merging the config from the package.
    *
    * @return  void
    */
    public function register()
    {
    }

    private function handlePublishing() {
        $this->publishes([
            __DIR__.'/../config/laravel_wd_my_cloud_api.php' => config_path('laravel_wd_my_cloud_api.php'),
        ], 'laravel-wd-my-cloud-api-config');
    }

    private function handleConfig()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/laravel_wd_my_cloud_api.php',
            'config'
        );
    }

    private function handleRoutes() {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/routes.php');
        });
    }

    private function routeConfiguration() {
        return [
            'prefix' => 'mycloud',
            'middleware' => 'web',
            'namespace' => 'StevenHardyDigital\LaravelWdMyCloudApi\Http\Controllers'
        ];
    }

    private function handleViews() {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'mycloud');
    }
}