<?php

namespace App\Repositories\Presenters;

use App\Repositories\Transformers\DataTraceTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class DataTracePresenter.
 *
 * @package namespace App\Repositories\Presenters;
 */
class DataTracePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new DataTraceTransformer();
    }
}
