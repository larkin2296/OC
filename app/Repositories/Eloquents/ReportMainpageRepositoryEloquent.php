<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\ReportMainpageRepository;
use App\Repositories\Models\ReportMainpage;
use App\Repositories\Validators\ReportMainpageValidator;
use App\Traits\EncryptTrait;
use Illuminate\Container\Container as Application;

/**
 * Class ReportMainpageRepositoryEloquent
 * @package namespace App\Repositories\Eloquents;
 */
class ReportMainpageRepositoryEloquent extends BaseRepository implements ReportMainpageRepository
{

    use EncryptTrait;

    public function __construct(Application $app)
    {
        parent::__construct($app);

        $this->setEncryptConnection('reportmainpage');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ReportMainpage::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
