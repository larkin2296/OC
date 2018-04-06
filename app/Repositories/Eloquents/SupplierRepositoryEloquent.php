<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\SupplierRepository;
use App\Repositories\Models\Supplier;
use App\Repositories\Validators\SupplierValidator;

/**
 * Class SupplierRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class SupplierRepositoryEloquent extends BaseRepository implements SupplierRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Supplier::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
