<?php

namespace App\Repositories\Eloquents;

use App\Traits\EncryptTrait;
use Illuminate\Container\Container as Application;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\LogisticsRepository;
use App\Repositories\Models\Logistics;
use App\Repositories\Validators\LogisticsValidator;

/**
 * Class LogisticsRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class LogisticsRepositoryEloquent extends BaseRepository implements LogisticsRepository
{
    use EncryptTrait;

    public function __construct(Application $app)
    {
        parent::__construct($app);

        $this->setEncryptConnection('logistics');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Logistics::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return LogisticsValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getList($report_identifier)
    {
        $companyId = getCompanyId();
        return $this->model->companyId($companyId)->reportIdentifier($report_identifier)->get();
    }

}
