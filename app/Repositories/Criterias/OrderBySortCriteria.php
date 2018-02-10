<?php

namespace App\Repositories\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class OrderBySortCriteria
 * @package namespace App\Repositories\Criterias;
 */
class OrderBySortCriteria implements CriteriaInterface
{   
    protected $order;
    protected $field;
    public function __construct($order = 'desc', $field = 'sort')
    {
        $this->order = $order;
        $this->field = $field;
    }
    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->orderBy($this->field, $this->order);
    }
}
