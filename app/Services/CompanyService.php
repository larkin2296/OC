<?php 

namespace App\Services;

use Yajra\DataTables\Html\Builder;
use App\Traits\ResultTrait;
use App\Traits\ExceptionTrait;
use App\Traits\ServiceTrait;
use App\Traits\Services\Permission\PermissionTrait;
use DataTables;
use Exception;
use DB;

class CompanyService extends Service
{
	use ServiceTrait, ResultTrait, ExceptionTrait, PermissionTrait;

	public function __construct(Builder $builder)
	{
		parent::__construct();
		$this->builder = $builder;
	}

	
}