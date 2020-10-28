<?php

namespace Epigra\NovaSettings\Services\NovaSetting;

use Epigra\NovaSettings\DTO\NovaSetting\NovaSettingDTO;
use Epigra\NovaSettings\Repositories\NovaSetting\NovaSettingRepositoryInterface;
use Epigra\Core\Services\Base\BaseService;
use Illuminate\Database\Eloquent\Model;

class NovaSettingService extends BaseService implements NovaSettingServiceInterface
{
    /**
     * @var NovaSettingRepositoryInterface
     */
    private NovaSettingRepositoryInterface $repository;


    /**
     * NovaSettingService constructor.
     * @param NovaSettingRepositoryInterface $repository
     */
    public function __construct(NovaSettingRepositoryInterface $repository)
    {
        parent::__construct($repository, NovaSettingDTO::class);
        $this->repository = $repository;
    }

    /**
     * @inherit
     */
    public function findByKey(string $key): ?Model
    {
        return $this->repository->findByKey($key);
    }
}
