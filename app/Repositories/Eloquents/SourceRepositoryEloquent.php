<?php

namespace App\Repositories\Eloquents;

use App\Traits\EncryptTrait;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\SourceRepository;
use App\Repositories\Models\Source;
use App\Repositories\Validators\SourceValidator;
use Illuminate\Container\Container as Application;
/**
 * Class SourceRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class SourceRepositoryEloquent extends BaseRepository implements SourceRepository
{
    use EncryptTrait;
    public function __construct(Application $app)
    {
        parent::__construct($app);

        $this->setEncryptConnection('source');
    }
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Source::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return SourceValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
