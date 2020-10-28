<?php

namespace Epigra\NovaSettings\Http\Controllers\Api;

use Epigra\Core\Controller\BaseApiController;
use Epigra\NovaSettings\DTO\NovaSetting\NovaSettingDTO;
use Epigra\NovaSettings\Services\NovaSetting\NovaSettingServiceInterface;
use Illuminate\Http\Request;

class SettingsApiController extends BaseApiController
{
    public function __construct(NovaSettingServiceInterface $service)
    {
        $this->service = $service;
        $this->dtoClass = NovaSettingDTO::class;
    }

    public function findByKey(string $key)
    {
        $result = $this->service->findByKey($key);
        return $this->ok($result);
    }
}
