<?php

namespace App\Repositories\Interfaces;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface RegulationRepository.
 *
 * @package namespace App\Repositories\Interfaces;
 */
interface RegulationRepository extends RepositoryInterface
{
    public function getRegulationsBySeverity($companyId,$severity);
}
