<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\MenuRepository;
use App\Repositories\Models\Menu;
use App\Repositories\Validators\MenuValidator;
use App\Traits\EncryptTrait;
use Illuminate\Container\Container as Application;

/**
 * Class MenuRepositoryEloquent
 * @package namespace App\Repositories\Eloquents;
 */
class MenuRepositoryEloquent extends BaseRepository implements MenuRepository
{
    use EncryptTrait;

    public function __construct(Application $app)
    {
        parent::__construct($app);

        $this->setEncryptConnection('menu');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Menu::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return MenuValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
