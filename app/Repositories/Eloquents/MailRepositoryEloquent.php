<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\MailRepository;
use App\Repositories\Models\Mail;
use App\Repositories\Validators\MailValidator;

/**
 * Class MailRepositoryEloquent
 * @package namespace App\Repositories\Eloquents;
 */
class MailRepositoryEloquent extends BaseRepository implements MailRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Mail::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
