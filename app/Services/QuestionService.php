<?php
namespace App\Services;
use App\Services\Service as BasicService;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use App\Traits\ResultTrait;
use App\Traits\ExceptionTrait;
use App\Traits\ServiceTrait;
use App\Traits\Services\Question\QuestionTrait;
use Yajra\DataTables\DataTables;
use Exception;
use DB;

Class QuestionService extends BasicService{
    use ResultTrait , ExceptionTrait , ServiceTrait ,QuestionTrait;
    public function __construct(Builder $builder)
    {
        parent::__construct();
        $this->builder = $builder;
    }
    public function datatables()
    {
        $data = $this->questionRepo->all();
        $searchFields = [
            'question_num' => 'like',
            'report_num' => 'like',
            'status' => '=',
            'operation_name' => 'like',
        ];
        /*获取查询条件*/
        $where = $this->searchArray($searchFields);
        /*获取数据*/
        $data = $this->questionRepo->findWhere($where);
        return DataTables::of($data)
            ->addColumn('action', getThemeTemplate('back.quality.question.datatable'))
            ->addColumn('status', getThemeTemplate('back.homepage.questioning.status'))
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
