<?php

namespace Epigra\NovaSettings\Repositories\NovaSetting;

use Epigra\NovaSettings\Models\NovaSetting;
use Epigra\Core\Repositories\Base\BaseEloquentRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class NovaSettingRepository extends BaseEloquentRepository implements NovaSettingRepositoryInterface
{
    /**
     * SlideRepository constructor.
     */
    public function __construct()
    {
        parent::__construct(NovaSetting::class);
    }

    /**
     * @inherit
     */
    public function findByKey(string $key): ?Model
    {
        return $this->model::where('key', $key)
            ->first();
    }


}
