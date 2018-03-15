<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\WorkflowRepository;
use App\Repositories\Models\Workflow;
use App\Repositories\Validators\WorkflowValidator;
use App\Traits\EncryptTrait;
use Illuminate\Container\Container as Application;

/**
 * Class WorkflowRepositoryEloquent
 * @package namespace App\Repositories\Eloquents;
 */
class WorkflowRepositoryEloquent extends BaseRepository implements WorkflowRepository
{

    use EncryptTrait;

    public function __construct(Application $app)
    {
        parent::__construct($app);

        $this->setEncryptConnection('workflow');
    }
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Workflow::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return WorkflowValidator::class;
    }

    /**
     * 停用工作流
     * @param  [type] $companyId [description]
     * @return [type]            [description]
     */
    public function closeWorkflow($companyId)
    {
        $results = $this->model->where('company_id', $companyId)->update([
            'is_use' => getCommonCheckValue(false)
        ]);

        $this->resetModel();

        return $results;
    }

    /**
     * 启用工作流
     * @param  [type] $companyId [description]
     * @return [type]            [description]
     */
    public function openWorkflow($companyId, $workflowId)
    {
        $results = $this->model
                        ->where('company_id', $companyId)
                        ->where('id', $workflowId)
                        ->update([
                            'is_use' => getCommonCheckValue(true)
                        ]);

        $this->resetModel();

        return $results;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
