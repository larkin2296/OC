<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Models\Subdictionaries;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\SubdictionariesRepository;
use App\Repositories\Models\Subdictonaries;
use App\Repositories\Validators\SubdictonariesValidator;

/**
 * Class SubdictonariesRepositoryEloquent
 * @package namespace App\Repositories\Eloquents;
 */
class SubdictionariesRepositoryEloquent extends BaseRepository implements SubdictionariesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Subdictionaries::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
