<?php

namespace Hmimeee\Easysendsms;

use Illuminate\Support\ServiceProvider;
use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\Facades\Notification;
use Hmimeee\Easysendsms\Channels\EasysendsmsChannel;

class EasysendsmsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'easysendsms');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'easysendsms');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('easysendsms.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/easysendsms'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/easysendsms'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/easysendsms'),
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
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'easysendsms');

        $this->app->bind(EasysendsmsChannel::class, function ($app) {
            return new EasysendsmsChannel(
                $app['config']['easysendsms']['username'],
                $app['config']['easysendsms']['password'],
                $app['config']['easysendsms']['from']
            );
        });

        Notification::resolved(function (ChannelManager $service) {
            $service->extend('sms', function ($app) {
                return $app->make(EasysendsmsChannel::class);
            });
        });
    }
}
