<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\AttachmentRepository;
use App\Repositories\Models\Attachment;
use App\Repositories\Validators\AttachmentValidator;
use App\Traits\EncryptTrait;
use Illuminate\Container\Container as Application;

/**
 * Class AttachmentRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class AttachmentRepositoryEloquent extends BaseRepository implements AttachmentRepository
{
    use EncryptTrait;

    public function __construct(Application $app)
    {
        parent::__construct($app);
        
        $this->setEncryptConnection('attachment');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Attachment::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return AttachmentValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
