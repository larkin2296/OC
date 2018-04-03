<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\PlatformConfigRepository;
use App\Repositories\Models\PlatformConfig;
use App\Repositories\Validators\PlatformConfigValidator;

/**
 * Class PlatformConfigRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class PlatformConfigRepositoryEloquent extends BaseRepository implements PlatformConfigRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PlatformConfig::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
