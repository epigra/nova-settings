<?php

namespace Epigra\NovaSettings\Repositories\NovaSetting;

use Epigra\NovaSettings\Models\NovaSetting;
use Epigra\Core\Repositories\Base\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface NovaSettingRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Returns a setting by key.
     * @param string $key
     * @return ?Model
     */
    public function findByKey(string $key): ?Model;
}