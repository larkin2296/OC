<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\PermissionRepository;
use App\Permission;
use App\Repositories\Validators\PermissionValidator;
use App\Traits\EncryptTrait;
use Illuminate\Container\Container as Application;

/**
 * Class PermissionRepositoryEloquent
 * @package namespace App\Repositories\Eloquents;
 */
class PermissionRepositoryEloquent extends BaseRepository implements PermissionRepository
{
    use EncryptTrait;

    public function __construct(Application $app)
    {
        parent::__construct($app);

        $this->setEncryptConnection('permission');
    }
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Permission::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PermissionValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
