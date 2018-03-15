<?php

namespace App\Repositories\Presenters;

use App\Repositories\Transformers\WorkflowNodeTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class WorkflowNodePresenter
 *
 * @package namespace App\Repositories\Presenters;
 */
class WorkflowNodePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new WorkflowNodeTransformer();
    }
}
