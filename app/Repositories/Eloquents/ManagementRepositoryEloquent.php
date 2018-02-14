<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\ManagementRepository;
use App\Repositories\Models\Management;
use App\Repositories\Validators\ManagementValidator;

/**
 * Class ManagementRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class ManagementRepositoryEloquent extends BaseRepository implements ManagementRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Management::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
