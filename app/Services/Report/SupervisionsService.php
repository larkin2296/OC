<?php
/**
 * Created by PhpStorm.
 * User: xinxin.lv
 * Date: 2018/1/30
 * Time: 下午8:17
 */

namespace App\Services\Report;

use App\Traits\ResultTrait;
use App\Traits\ExceptionTrait;
use App\Traits\ServiceTrait;
use Exception;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\DataTables;
use DB;
use App\Services\Service;
class SupervisionsService extends Service{
    use ServiceTrait,ResultTrait,ExceptionTrait;
    protected $builder;
    public function __construct(Builder $builder)
    {
        parent::__construct();
        $this->builder = $builder;
    }

    public function datatables()
    {
        $model = $this->reportMainpageRepo->all();

        return DataTables::of($model)
            ->editColumn('id', '{{ $id_hash }}')
            ->addColumn('action', getThemeTemplate('back.report.supervision.datatable'))
            ->make();
    }

    public function index()
    {
        $html = $this->builder->columns([
            ['data' => 'report_identifier', 'name' => 'report_identifier', 'title' => '报告编号'],
            ['data' => 'received_from_id', 'name' => 'received_from_id', 'title' => '企业报告类型'],
            ['data' => 'report_first_received_date', 'name' => 'report_first_received_date', 'title' => '收到报告日期'],
            ['data' => 'first_drug_name', 'name' => 'first_drug_name', 'title' => '药品名称'],
            ['data' => 'first_event_term', 'name' => 'first_event_term', 'title' => '不良事件'],
            ['data' => 'received_fromid_id', 'name' => 'received_fromid_id', 'title' => '报告类型'],
            ['data' => 'regulation_id', 'name' => 'regulation_id', 'title' => '严重性标准'],
            ['data' => 'id', 'name' => 'id', 'title' => '因果关系'],
            ['data' => 'id', 'name' => 'id', 'title' => '上报状态'],
            ['data' => 'id', 'name' => 'id', 'title' => '国家ADR编号'],
            ['data' => 'id', 'name' => 'id', 'title' => '上报时间'],
            ['data' => 'action', 'name' => 'action', 'title' => '操作'],
        ])
            ->ajax([
                'url' => route('admin.supervision.index'),
                'type' => 'GET',
            ]);


        return [
            'html' => $html,
            'drug_class'=>[] #左侧树型分类
        ];


    }

    public function immediately($id){
        #TODO::
    }

    public function noNeed($id){
        try {
            $exception = DB::transaction(function () use ($id) {
                $id = $this->reportMainpageRepo->decodeId($id);
                # 无须上报，即把上报状态改为无须上报状态
                if ($source = $this->reportMainpageRepo->update(['' => 1], $id)) {
                    #TODO:: other logic
                } else {
                    throw new Exception(trans('code/supervision.noNeed.fail'), 2);
                }

                return array_merge($this->results, [
                    'result' => true,
                    'message' => trans('code/supervision.noNeed.success'),
                ]);
            });
        } catch (Exception $e) {
            $exception = array_merge($this->results, [
                'result' => false,
                'message' => $this->handler($e, trans('code/supervision.noNeed.fail')),
            ]);
        }

        return array_merge($this->results, $exception);
    }
}