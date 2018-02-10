<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\SupervisionRepository;
use App\Repositories\Models\Supervision;
use App\Repositories\Validators\SupervisionValidator;

/**
 * Class SupervisionRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class SupervisionRepositoryEloquent extends BaseRepository implements SupervisionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Supervision::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return SupervisionValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
