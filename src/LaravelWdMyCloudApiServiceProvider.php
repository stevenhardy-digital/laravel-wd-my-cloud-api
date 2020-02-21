<?php
namespace StevenHardyDigital\LaravelWdMyCloudApi;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use StevenHardyDigital\LaravelWdMyCloudApi\OAuth\MyCloudProvider;
use Laravel\Socialite\SocialiteServiceProvider;

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
        $this->extendSocialite();
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
            __DIR__.'/../config/mycloud.php' => config_path('mycloud.php'),
        ], 'mycloud-config');

        $this->app->bind('StevenHardyDigital\LaravelWdMyCloudApi\MyCloud', function($app) {
            return new MyCloud($app);
        });

    }

    private function handleConfig()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/mycloud.php',
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
            'namespace' => 'StevenHardyDigital\LaravelWdMyCloudApi\Controllers'
        ];
    }

    private function handleViews() {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'mycloud');
    }

    protected function extendSocialite() {
        if (interface_exists('Laravel\Socialite\Contracts\Factory')) {
            $socialite = $this->app->make('Laravel\Socialite\Contracts\Factory');

            $socialite->extend('mycloud', function ($app) use ($socialite) {
                $config = $app['config']['services.mycloud'];

                return $socialite->buildProvider(MyCloudProvider::class, $config);
            });
        }
    }
}