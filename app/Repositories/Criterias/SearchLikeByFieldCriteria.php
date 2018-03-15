<?php

namespace App\Repositories\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class SearchLikeByFieldCriteria
 * @package namespace App\Repositories\Criterias;
 */
class SearchLikeByFieldCriteria implements CriteriaInterface
{
    protected $field;
    protected $value;
    protected $way;
    public function __construct($field, $value, $way = 'left')
    {
        $this->field = $field;
        $this->value = $value;
        $this->way = $way;
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
        $likeValue = $this->value;
        switch($this->way) {
            case 'left' : 
                $likeValue = '%' . $likeValue;
                break;
            case 'right' :
                $likeValue = $likeValue . '%';
                break;
            case 'both' :
                $likeValue = '%' . $likeValue . '%';
                break;
        }
        return $model->where($this->field, 'like', $likeValue);
    }
}
