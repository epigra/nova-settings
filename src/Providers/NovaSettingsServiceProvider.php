<?php

namespace Epigra\NovaSettings\Providers;

use Epigra\NovaSettings\Http\Middleware\Authorize;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Nova;

class NovaSettingsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'nova-settings');

        $this->registerRoutes();

        if ($this->app->runningInConsole()) {
            // Publish config
            $this->publishes([
                __DIR__.'/../Config/' => config_path(),
            ], 'config');
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../Config/nova-settings.php',
            'nova-settings'
        );
    }

    protected function registerRoutes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova', Authorize::class])
            ->group(__DIR__.'/../Routes/api.php');
    }
}
