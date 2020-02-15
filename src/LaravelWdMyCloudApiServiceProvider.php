<?php
namespace StevenHardyDigital\LaravelWdMyCloudApi;

use Illuminate\Support\ServiceProvider;
class LaravelWdMyCloudApiServiceProvider extends ServiceProvider
{
    /**
    * Publishes configuration file.
    *
    * @return  void
    */
    public function boot()
    {
        $this->handlePublishing();
    }
    /**
    * Make config publishment optional by merging the config from the package.
    *
    * @return  void
    */
    public function register()
    {
        $this->handleConfig();
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
}