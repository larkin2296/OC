<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\OcloginRepository;
use App\Repositories\Models\Oclogin;
use App\Repositories\Validators\OcloginRepositoryValidator;

/**
 * Class LoginRepositoryRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class OcloginRepositoryEloquent extends BaseRepository implements OcloginRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Oclogin::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
