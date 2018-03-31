<?php
namespace App\Services\OcService;

use Yajra\DataTables\Html\Builder;
use App\Services\Service;
use App\Traits\ResultTrait;
use App\Traits\ExceptionTrait;
use App\Traits\ServiceTrait;
use DB;
use DataTables;

class OilCardBindingService extends Service
{
    use ServiceTrait, ResultTrait, ExceptionTrait;

    public function __construct(Builder $builder)
    {
        parent::__construct();
        $this->builder = $builder;
    }
    public function search($fields)
    {
        return $this->oilcardbindingRepo->findWhere($fields)->all();
    }
    public function create(){
        $request = request()->except(['_token']);
        $request['user_id'] = request()->user()->id;
        $info = $this->oilcardbindingRepo->create($request);
    }
}
