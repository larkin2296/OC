<?php

namespace App\Repositories\Eloquents;

use App\Traits\EncryptTrait;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\RegulationRepository;
use App\Repositories\Models\Regulation;
use App\Repositories\Validators\RegulationValidator;
use Illuminate\Container\Container as Application;

/**
 * Class RegulationRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class RegulationRepositoryEloquent extends BaseRepository implements RegulationRepository
{

    use EncryptTrait;

    public function __construct(Application $app)
    {
        parent::__construct($app);

        $this->setEncryptConnection('regulation');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Regulation::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return RegulationValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getRegulationsBySeverity($companyId, $severity)
    {
        try{
            $regulation =  $this->model->companyId($companyId)->severity($severity)->first();
            if(empty($regulation)) throw new \Exception(trans('code/regulation.show.fail'),2);
            return $regulation;
        }
        catch (\Exception $e){
            return false;
        }


    }

}
