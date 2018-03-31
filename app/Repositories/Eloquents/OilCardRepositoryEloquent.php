<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\OilCardRepository;
use App\Repositories\Models\OilCard;
use App\Repositories\Validators\OilCardValidator;

/**
 * Class OilCardRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class OilCardRepositoryEloquent extends BaseRepository implements OilCardRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OilCard::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
