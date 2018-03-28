<?php
namespace App\Services\OcService;

use Yajra\DataTables\Html\Builder;
use App\Services\Service;
use App\Traits\ResultTrait;
use App\Traits\ExceptionTrait;
use App\Traits\ServiceTrait;
use App\Traits\DictionariesTrait;
use App\Traits\Services\Report\MainTrait;
use App\Events\Report\Main;
use Exception;
use DB;
use DataTables;

class ListService extends Service
{
    use ServiceTrait, ResultTrait, ExceptionTrait;

    public function __construct(Builder $builder)
    {
        parent::__construct();
        $this->builder = $builder;
    }
    public function search()
    {
        $this->searchArray();
    }


}