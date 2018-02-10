<?php
namespace App\Services;
use App\Services\Service as BasicService;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use App\Traits\ResultTrait;
use App\Traits\ExceptionTrait;
use App\Traits\ServiceTrait;

use Yajra\DataTables\DataTables;
use Exception;
use DB;

Class EnterpriseService extends BasicService{
    use ResultTrait , ExceptionTrait , ServiceTrait;
    public function __construct(Builder $builder)
    {
        parent::__construct();
        $this->builder = $builder;
    }
    public function datatables()
    {
        $data = $this->enterpriseRepo->all('sort_id','name','enterprise_type','parent company_name','enterprise_adress');
        return DataTables::of($data)
            ->editColumn('id', '{{$id_hash}}')
            ->editColumn('status', getThemeTemplate('back.basic.enterprise.index'))
            ->addColumn('action', getThemeTemplate('back.basic.enterprise.datatable'))

            ->make();
    }
    public function index()
    {
        $html = $this->builder->columns([
            ['data' => 'question_num', 'name' => 'question_num', 'title' => '质疑编号', 'class' => 'text-center'],
            ['data' => 'report_num', 'name' => 'report_num', 'title' => '报告编号', 'class' => 'text-center'],
            ['data' => 'operation_name', 'name' => 'operation_name', 'title' => '操作人', 'class' => 'text-center'],
            ['data' => 'status', 'name' => 'status', 'title' => '状态'],
            ['data' => 'operation_date', 'name' => 'operation_date', 'title' => '操作时间', 'class' => 'text-center'],
            ['data' => 'content', 'name' => 'content', 'title' => '内容'],
            ['data' => 'end_date', 'name' => 'end_date', 'title' => '截止时间', 'class' => 'text-center'],
            ['data' => 'sending', 'name' => 'sending', 'title' => '发送次数', 'class' => 'text-center'],
            ['data' => 'action', 'name' => 'action', 'title' => '操作', 'class' => 'text-center', 'sorting' => false]
        ])
            ->ajax([
                'url' => route('admin.question.index'),
                'type' => 'GET',
            ])->parameters(config('back.datatables-cfg.basic'));
        return [
            'html' => $html
        ];

    }


}
