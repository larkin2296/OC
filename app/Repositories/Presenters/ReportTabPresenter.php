<?php

namespace App\Repositories\Presenters;

use App\Repositories\Transformers\ReportTabTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ReportTabPresenter.
 *
 * @package namespace App\Repositories\Presenters;
 */
class ReportTabPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ReportTabTransformer();
    }
}
