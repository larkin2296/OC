<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\PurchasingRepository;
use App\Repositories\Models\Purchasing;
use App\Repositories\Validators\PurchasingValidator;

/**
 * Class PurchasingRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class PurchasingRepositoryEloquent extends BaseRepository implements PurchasingRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Purchasing::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
