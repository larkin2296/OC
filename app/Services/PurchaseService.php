<?php
namespace App\Services;

use Yajra\DataTables\Html\Builder;
use App\Traits\ResultTrait;
use App\Traits\ExceptionTrait;
use App\Traits\ServiceTrait;
use DataTables;
use Exception;
use DB;

Class PurchaseService extends Service{
    use ServiceTrait, ResultTrait, ExceptionTrait;

    public function __construct(Builder $builder)
    {
        parent::__construct();
        $this->builder = $builder;
    }
    /*多条件查询*/
    public function datatables()
    {
        $searchFields = [
            'purchase_number' => 'like',
            'denomination' => 'like',
            'number' => '=',
        ];
        /*获取查询条件*/
        $where = $this->searchArray($searchFields);
        /*获取数据*/
        $data = $this->managementRepo->findWhere($where);
        return DataTables::of($data)
            ->addColumn('action', getThemeTemplate('back.quality.question.datatable'))
            ->addColumn('status', getThemeTemplate('back.homepage.questioning.status'))
            ->make();
    }
}