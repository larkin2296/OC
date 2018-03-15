<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\RoleRepository;
use App\Role;
use App\Repositories\Validators\RoleValidator;
use App\Traits\EncryptTrait;
use Illuminate\Container\Container as Application;

/**
 * Class RoleRepositoryEloquent
 * @package namespace App\Repositories\Eloquents;
 */
class RoleRepositoryEloquent extends BaseRepository implements RoleRepository
{
    use EncryptTrait;

    public function __construct(Application $app)
    {
        parent::__construct($app);

        $this->setEncryptConnection('role');
    }
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Role::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return RoleValidator::class;
    }

    /**
     * 获取组织结构的角色
     * @return [type] [description]
     */
    public function organizeRoles($organizeRoleId)
    {
        $this->applyCriteria();
        $this->applyScope();

        $results = $this->model->where('organize_role_id', $organizeRoleId)->get();

        $this->resetModel();

        return $results;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
