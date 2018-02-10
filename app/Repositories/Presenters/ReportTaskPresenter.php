<?php

namespace App\Repositories\Presenters;

use App\Repositories\Transformers\ReportTaskTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ReportTaskPresenter.
 *
 * @package namespace App\Repositories\Presenters;
 */
class ReportTaskPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ReportTaskTransformer();
    }
}
