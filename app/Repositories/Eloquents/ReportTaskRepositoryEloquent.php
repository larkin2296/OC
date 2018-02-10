<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\ReportTaskRepository;
use App\Repositories\Models\ReportTask;
use App\Repositories\Validators\ReportTaskValidator;
use App\Traits\EncryptTrait;
use App\Traits\RepositoryTrait;
use Illuminate\Container\Container as Application;

/**
 * Class ReportTaskRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class ReportTaskRepositoryEloquent extends BaseRepository implements ReportTaskRepository
{

    use EncryptTrait, RepositoryTrait;

    public function __construct(Application $app)
    {
        parent::__construct($app);

        $this->setEncryptConnection('reporttask');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ReportTask::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ReportTaskValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        // $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
