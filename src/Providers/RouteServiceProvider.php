<?php

namespace Epigra\NovaSettings\Providers;

use Epigra\Core\Providers\BaseRouteServiceProvider;

class RouteServiceProvider extends BaseRouteServiceProvider
{
    public function boot()
    {
        $this->setModuleName('NovaSettings');
        parent::boot();
    }
}

