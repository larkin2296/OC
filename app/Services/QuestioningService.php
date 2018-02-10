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
use Illuminate\Support\Facades\DB;

Class QuestioningService extends BasicService
{
    use ResultTrait, ExceptionTrait, ServiceTrait, QuestionTrait;

    public function __construct(Builder $builder)
    {
        parent::__construct();
        $this->builder = $builder;
    }

    public function datatables()
    {
        $data = $this->questionRepo->findWhereNotIn('status', ['1'])->all();
        return DataTables::of($data)
            ->addColumn('action', getThemeTemplate('back.homepage.questioning.datatable'))
            ->addColumn('status', getThemeTemplate('back.homepage.questioning.status'))
            ->make();
    }

    /*发送页面*/
    public function show($id)
    {
        try {
            /*发送质疑的数据*/
            $data = $info = $this->questionRepo->find($id, ['id', 'end_date', 'content']);
            return [
                'data' => $data,
          ];
        } catch (Exception $e) {
            abort(404);
        }
    }



    /*发送质疑*/
    public function create()
    {
        try {
            $exception = DB::transaction(function (){
                if ($send = $this->questioningRepo->create(request()->all())) {
                    /*获取关联数据*/
//['question_id'=>3,'end_data'=>'2018/1/23','content'=>'服务信息14.12','status'=>1]
                    $question_id = $send->question_id;
                    $end_date = $send->end_date;
                    $content = $send->content;
                    $status = $send->status;
                    $id = $send->id;
                    $info = $this->send($question_id,$end_date,$content,$id,$status);
                } else {
                    throw new Exception(trans('code/questioning.create.fail'), 2);
                }

                return array_merge($this->results, [
                    'result' => true,
                    'data'=>$send,
                    'message' => trans('code/questioning.create.success'),
                ]);
            });
        } catch (Exception $e) {
            $exception = array_merge($this->results, [
                'result' => false,
                'message' => $this->handler($e, trans('code/questioning.create.fail')),
            ]);
        }

        return array_merge($this->results, $exception);
    }
    /*关闭质疑状态*/
    public function end($id)
    {
        try {
            $exception = DB::transaction(function() use ($id) {
                //关闭质疑状态
                if( $status = $this->questionRepo->update(['status'=>1],$id) ) {
                } else {
                    throw new Exception(trans('code/questioning.end.fail'), 2);
                }

                return array_merge($this->results, [
                    'result' => true,
                    'message' => trans('code/questioning.end.success'),
                ]);
            });
        } catch (Exception $e) {
            $exception = array_merge($this->results, [
                'result' => false,
                'message' => $this->handler($e, trans('code/questioning.end.fail')),
            ]);
        }

        return array_merge($this->results, $exception);

    }
    public function index()
    {
        $html = $this->builder->columns([
            // ['data' => 'id', 'name' => 'id', 'title' => 'Id'],
            ['data' => 'question_num', 'name' => 'question_num', 'title' => '质疑编号', 'class' => 'text-center'],
            ['data' => 'report_num', 'name' => 'report_num', 'title' => '报告编号', 'class' => 'text-center'],
            ['data' => 'operation_name', 'name' => 'operation_name', 'title' => '操作人', 'class' => 'text-center'],
            // ['data' => 'operation_id', 'name' => 'operation_id', 'title' => 'operation_id'],
            ['data' => 'status', 'name' => 'status', 'title' => '状态', 'class' => 'text-center'],
            ['data' => 'operation_date', 'name' => 'operation_date', 'title' => '操作日期', 'class' => 'text-center'],
            ['data' => 'content', 'name' => 'content', 'title' => '内容'],
            ['data' => 'end_date', 'name' => 'end_date', 'title' => '截止日期', 'class' => 'text-center'],
            ['data' => 'sending', 'name' => 'sending', 'title' => '发送次数', 'class' => 'text-center'],
            // ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
            // ['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Updated At'],
            ['data' => 'action', 'name' => 'action', 'title' => '操作', 'class' => 'text-center', 'sorting' => false]
        ])
            ->ajax([
                'url' => route('admin.questioning.index'),
                'type' => 'GET',
            ])->parameters(config('back.datatables-cfg.basic'));
        return [
            'html' => $html
        ];

    }

}
