<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\RecursiveRelationRepository;
use App\Repositories\Models\RecursiveRelation;
use App\Repositories\Validators\RecursiveRelationValidator;
use App\Traits\EncryptTrait;
use Illuminate\Container\Container as Application;

/**
 * Class RecursiveRelationRepositoryEloquent
 * @package namespace App\Repositories\Eloquents;
 */
class RecursiveRelationRepositoryEloquent extends BaseRepository implements RecursiveRelationRepository
{
    use EncryptTrait;

    public function __construct(Application $app)
    {
        parent::__construct($app);

        $this->setEncryptConnection('recursiverelation');
    }
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return RecursiveRelation::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return RecursiveRelationValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
