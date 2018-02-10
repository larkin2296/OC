<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\enterpriseRepository;
use App\Repositories\Models\Enterprise;
use App\Repositories\Validators\EnterpriseValidator;

/**
 * Class EnterpriseRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class EnterpriseRepositoryEloquent extends BaseRepository implements EnterpriseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Enterprise::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
