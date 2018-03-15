<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\questioningRepository;
use App\Repositories\Models\Questioning;
use App\Repositories\Validators\QuestioningValidator;

/**
 * Class QuestioningRepositoryEloquent
 * @package namespace App\Repositories\Eloquents;
 */
class QuestioningRepositoryEloquent extends BaseRepository implements QuestioningRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Questioning::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
