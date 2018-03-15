<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\DictionariesRepository;
use App\Repositories\Models\Dictionaries;
use App\Repositories\Validators\DictionariesValidator;

/**
 * Class DictionariesRepositoryEloquent
 * @package namespace App\Repositories\Eloquents;
 */
class DictionariesRepositoryEloquent extends BaseRepository implements DictionariesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Dictionaries::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

//    public function datatables($data)
//    {
//     $diction = $this->model();
//     $diction->add($data);
//     return $diction;
//    }

}
