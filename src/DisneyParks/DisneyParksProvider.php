<?php

namespace fyroc\DisneyParks;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;

class DisneyParksProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (Config::get('disney-parks.enableAPI')) {
            // Routes
            $this->loadRoutesFrom(__DIR__.'/resources/routes.php');
        }

        // Config publish
        $this->publishes([
            __DIR__.'/resources/config/disney-parks.php' => "{$this->app->configPath()}/disney-parks.php",
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
         // ShopifyApp facade
         $this->app->bind('disneyparks', function ($app) {
            return new DisneyParks($app);
        });
    }
}
