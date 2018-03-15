<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\ReportValuesRepository;
use App\Repositories\Models\ReportValues;
use App\Repositories\Validators\ReportValuesValidator;
use App\Traits\RepositoryTrait;

/**
 * Class ReportValuesRepositoryEloquent
 * @package namespace App\Repositories\Eloquents;
 */
class ReportValuesRepositoryEloquent extends BaseRepository implements ReportValuesRepository
{
    use RepositoryTrait;
    
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ReportValues::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ReportValuesValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
