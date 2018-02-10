<?php

namespace App\Repositories\Transformers;

use League\Fractal\TransformerAbstract;
use App\Repositories\Models\WorkflowNode;

/**
 * Class WorkflowNodeTransformer
 * @package namespace App\Repositories\Transformers;
 */
class WorkflowNodeTransformer extends TransformerAbstract
{

    /**
     * Transform the WorkflowNode entity
     * @param App\Repositories\Models\WorkflowNode $model
     *
     * @return array
     */
    public function transform(WorkflowNode $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
