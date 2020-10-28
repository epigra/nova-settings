<?php

namespace Epigra\NovaSettings\Services\NovaSetting;

use Epigra\NovaSettings\Models\NovaSetting;
use Epigra\Core\Services\Base\BaseServiceInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface NovaSettingServiceInterface
 * @package Epigra\NovaSettings\Services\NovaSetting\NovaSetting
 */
interface NovaSettingServiceInterface extends BaseServiceInterface
{
    /**
     * Returns a setting by key.
     * @param string $key
     * @return ?Model
     */
    public function findByKey(string $key): ?Model;
}
