<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\WorkflowNodeRepository;
use App\Repositories\Models\WorkflowNode;
use App\Repositories\Validators\WorkflowNodeValidator;
use App\Traits\EncryptTrait;
use Illuminate\Container\Container as Application;

/**
 * Class WorkflowNodeRepositoryEloquent
 * @package namespace App\Repositories\Eloquents;
 */
class WorkflowNodeRepositoryEloquent extends BaseRepository implements WorkflowNodeRepository
{

    use EncryptTrait;

    public function __construct(Application $app)
    {
        parent::__construct($app);

        $this->setEncryptConnection('workflownode');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return WorkflowNode::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return WorkflowNodeValidator::class;
    }

    /**
     * 工作流节点中，自动递增sort
     * @param  [type] $workflowId [description]
     * @param  [type] $sort       [description]
     * @return [type]             [description]
     */
    public function incrementLargerSort($workflowId, $sort)
    {
        $results = $this->model
                        ->where('workflow_id', $workflowId)
                        ->where('sort', '>', $sort)
                        ->increment('sort', 1);

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
