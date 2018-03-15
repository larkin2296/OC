<?php

namespace App\Repositories\Presenters;

use App\Repositories\Transformers\RecursiveRelationTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class RecursiveRelationPresenter
 *
 * @package namespace App\Repositories\Presenters;
 */
class RecursiveRelationPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new RecursiveRelationTransformer();
    }
}
