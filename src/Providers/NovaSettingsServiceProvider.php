<?php

namespace Epigra\NovaSettings\Providers;

use Epigra\Core\Providers\BaseServiceProvider;
use Epigra\NovaSettings\Http\Middleware\Authorize;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Nova;

class NovaSettingsServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->setModuleName('NovaSettings');
        parent::boot();
    }

    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(RepositoryServiceProvider::class);
        parent::register();
    }
}
