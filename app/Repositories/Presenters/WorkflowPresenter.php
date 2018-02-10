<?php

namespace App\Repositories\Presenters;

use App\Repositories\Transformers\WorkflowTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class WorkflowPresenter
 *
 * @package namespace App\Repositories\Presenters;
 */
class WorkflowPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new WorkflowTransformer();
    }
}
