<?php

namespace App\Repositories\Transformers;

use League\Fractal\TransformerAbstract;
use App\Repositories\Models\ReportTask;

/**
 * Class ReportTaskTransformer.
 *
 * @package namespace App\Repositories\Transformers;
 */
class ReportTaskTransformer extends TransformerAbstract
{
    /**
     * Transform the ReportTask entity.
     *
     * @param \App\Repositories\Models\ReportTask $model
     *
     * @return array
     */
    public function transform(ReportTask $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
