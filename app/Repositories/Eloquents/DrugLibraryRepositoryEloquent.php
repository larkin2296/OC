<?php

namespace App\Repositories\Eloquents;

use App\Traits\EncryptTrait;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\DrugLibraryRepository;
use App\Repositories\Models\DrugLibrary;
use App\Repositories\Validators\DrugLibraryValidator;
use Illuminate\Container\Container as Application;
/**
 * Class DrugLibraryRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class DrugLibraryRepositoryEloquent extends BaseRepository implements DrugLibraryRepository
{
    use EncryptTrait;

    public function __construct(Application $app)
    {
        parent::__construct($app);

        $this->setEncryptConnection('drug');
    }
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return DrugLibrary::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
