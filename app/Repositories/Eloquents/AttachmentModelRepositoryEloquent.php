<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\AttachmentModelRepository;
use App\Repositories\Models\AttachmentModel;
use App\Repositories\Validators\AttachmentModelValidator;

/**
 * Class AttachmentModelRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class AttachmentModelRepositoryEloquent extends BaseRepository implements AttachmentModelRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AttachmentModel::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return AttachmentModelValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
