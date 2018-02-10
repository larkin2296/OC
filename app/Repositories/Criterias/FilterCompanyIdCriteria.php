<?php

namespace App\Repositories\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterCompanyIdCriteria
 * @package namespace App\Repositories\Criterias;
 */
class FilterCompanyIdCriteria implements CriteriaInterface
{
    protected $value;
    public function __construct($value)
    {
        $this->value = $value;
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
        return $model->where('company_id', $this->value);
    }
}
