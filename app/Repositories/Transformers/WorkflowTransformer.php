<?php

namespace App\Repositories\Transformers;

use League\Fractal\TransformerAbstract;
use App\Repositories\Models\Workflow;

/**
 * Class WorkflowTransformer
 * @package namespace App\Repositories\Transformers;
 */
class WorkflowTransformer extends TransformerAbstract
{

    /**
     * Transform the Workflow entity
     * @param App\Repositories\Models\Workflow $model
     *
     * @return array
     */
    public function transform(Workflow $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
