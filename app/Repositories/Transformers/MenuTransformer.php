<?php

namespace App\Repositories\Transformers;

use League\Fractal\TransformerAbstract;
use App\Repositories\Models\Menu;

/**
 * Class MenuTransformer
 * @package namespace App\Repositories\Transformers;
 */
class MenuTransformer extends TransformerAbstract
{

    /**
     * Transform the Menu entity
     * @param App\Repositories\Models\Menu $model
     *
     * @return array
     */
    public function transform(Menu $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
