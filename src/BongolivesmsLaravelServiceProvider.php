<?php

/**
 * Author: Emmanuel Paul Mnzava
 * Twitter: @epmnzava
 * Github: https://github.com/dbrax/beem.africa-sms-laravel
 * Email: epmnzava@gmail.com
 * 
 */

namespace Epmnzava\BongolivesmsLaravel;

use Illuminate\Support\ServiceProvider;

class BongolivesmsLaravelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'bongolivesms-laravel');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'bongolivesms-laravel');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('beemafrica.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/bongolivesms-laravel'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/bongolivesms-laravel'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/bongolivesms-laravel'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'bongolivesms-laravel');

        // Register the main class to use with the facade
        $this->app->singleton('bongolivesms-laravel', function () {
            return new BongolivesmsLaravel;
        });
    }
}
