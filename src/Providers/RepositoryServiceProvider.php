<?php

namespace Epigra\NovaSettings\Providers;

use Epigra\NovaSettings\Repositories\NovaSetting\NovaSettingRepository;
use Epigra\NovaSettings\Repositories\NovaSetting\NovaSettingRepositoryInterface;
use Epigra\NovaSettings\Services\NovaSetting\NovaSettingService;
use Epigra\NovaSettings\Services\NovaSetting\NovaSettingServiceInterface;
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
        //repositories
        $this->app->bind(NovaSettingRepositoryInterface::class, NovaSettingRepository::class);

        //services
        $this->app->bind(NovaSettingServiceInterface::class, NovaSettingService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
