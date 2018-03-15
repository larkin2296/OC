<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\DataTraceRepository;
use App\Repositories\Models\DataTrace;
use App\Repositories\Validators\DataTraceValidator;

/**
 * Class DataTraceRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class DataTraceRepositoryEloquent extends BaseRepository implements DataTraceRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return DataTrace::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return DataTraceValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
