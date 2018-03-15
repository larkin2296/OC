<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\ReportTabRepository;
use App\Repositories\Models\ReportTab;
use App\Repositories\Validators\ReportTabValidator;
use App\Traits\EncryptTrait;
use Illuminate\Container\Container as Application;

/**
 * Class ReportTabRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class ReportTabRepositoryEloquent extends BaseRepository implements ReportTabRepository
{
    use EncryptTrait;

    public function __construct(Application $app)
    {
        parent::__construct($app);

        $this->setEncryptConnection('reporttab');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ReportTab::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ReportTabValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
