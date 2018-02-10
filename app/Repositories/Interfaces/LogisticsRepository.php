<?php

namespace App\Repositories\Interfaces;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface LogisticsRepository.
 *
 * @package namespace App\Repositories\Interfaces;
 */
interface LogisticsRepository extends RepositoryInterface
{
    //
    public function getList($report_identifier);
}
