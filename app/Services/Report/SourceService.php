<?php
/**
 * Created by PhpStorm.
 * User: xinxin.lv
 * Date: 2018/1/23
 * Time: 下午8:24
 */

namespace App\Services\Report;

use App\Traits\DictionariesTrait;
use App\Traits\ResultTrait;
use App\Traits\ExceptionTrait;
use App\Traits\Services\Workflow\WorkflowTrait;
use App\Traits\ServiceTrait;
use Exception;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\DataTables;
use DB;
use App\Services\Service;

class SourceService extends Service
{
    use ServiceTrait,ResultTrait,ExceptionTrait,WorkflowTrait,DictionariesTrait;
    protected $builder;
    public function __construct(Builder $builder)
    {
        parent::__construct();
        $this->builder = $builder;
    }

    public function store()
    {
        $data = request()->all();
        $data['company_id'] = getCompanyId() ;
        #TODO::研究方案编号  即当前的项目编号
        #$data['solution_number'] = '';
        try {
            $exception = DB::transaction(function () use ($data) {


                if ($cate = $this->sourceRepo->create($data)) {
                    if(isset($data['attach_ids']) && !empty($data['attach_ids'])){
                        $attach_id = $this->attachmentRepo->decodeId($data['attach_ids']);
                        $cate->attachments()->attach($attach_id);
                    }
                    else{
                        throw new Exception(trans('code/source.attach.attach_no_exists'), 2);
                    }
                } else {
                    throw new Exception(trans('code/source.store.fail'), 2);
                }

                return array_merge($this->results, [
                    'result' => true,
                    'message' => trans('code/source.store.success'),
                ]);
            });
        } catch (Exception $e) {
            $exception = array_merge($this->results, [
                'result' => false,
                'message' => $this->handler($e, trans('code/source.store.fail')),
            ]);
        }
        return array_merge($this->results, $exception);
    }

    public function datatables()
    {
        $model = $this->sourceRepo->makeModel();
        $model = $model->whereHas('attachments',function($query)use($model){
            return $query->where('attachment_model_type',get_class($model));
        });
        $model = $model->with('attachments');
        $model = $model->status(1);
        return DataTables::of($model)
            ->editColumn('id', '{{ $id_hash }}')
            ->addColumn('action', getThemeTemplate('back.report.source.datatable'))
            ->make();
    }

    public function index()
    {
        $html = $this->builder->columns([
            ['data' => 'attachments.name', 'name' => 'attachments.name', 'title' => '文件名'],
            ['data' => 'report_number', 'name' => 'report_number', 'title' => '报告编号'],
            ['data' => 'accept_report_date', 'name' => 'accept_report_date', 'title' => '接受报告时间'],
            ['data' => 'solution_number', 'name' => 'solution_number', 'title' => '研究方案编号'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => '创建时间'],
            ['data' => 'creator_name', 'name' => 'creator_name', 'title' => '创建人'],
            ['data' => 'action', 'name' => 'action', 'title' => '操作'],
        ])
            ->ajax([
                'url' => route('admin.source.index'),
                'type' => 'GET',
            ]);


        return [
            'html' => $html,
            'drug_class'=>[] #左侧树型分类
        ];


    }

    public function create()
    {

        #原始资料-添加-文件类型
        $fileClass = $this->hasManyDictionaries(['文件类型']);
        #原始资料-添加-文件来源
        $fileSource = $this->hasManyDictionaries(['文件来源']);
        #树型分类
        $drug_class = [];

        return [
            'file_class' => $fileClass,
            'file_source' => $fileSource,
            'drug_class' => $drug_class
        ];
    }

    public function edit($id)
    {
        try {
            #获取某个分类
            $id = $this->sourceRepo->decodeId($id);
            $source = $this->sourceRepo->find($id);
            #原始资料-添加-文件类型
            $fileClass = get_file_class();
            #原始资料-添加-文件来源
            $fileSource = get_file_source();
            #树型分类
            $drug_class = [];


            return [
                'source' => $source,
                'file_class' => $fileClass,
                'file_source' => $fileSource,
                'drug_class' => $drug_class
            ];
        } catch (Exception $e) {

            abort(404);
        }
    }

    public function show($id)
    {
        try {
            #获取某个分类
            $id = $this->sourceRepo->decodeId($id);
            $source = $this->sourceRepo->find($id);
            #原始资料-添加-文件类型
            $fileClass = get_file_class();
            #原始资料-添加-文件来源
            $fileSource = get_file_source();


            return [
                'source' => $source,
                'file_class' => $fileClass,
                'file_source' => $fileSource,
            ];
        } catch (Exception $e) {

            abort(404);
        }
    }

    public function update($id)
    {

        try {
            $exception = DB::transaction(function () use ($id) {
                $id = $this->sourceRepo->decodeId($id);
                $data = request()->all();

                if ($source = $this->sourceRepo->update($data, $id)) {
                    #TODO:: exec other logic
                } else {
                    throw new Exception(trans('code/source.update.fail'), 2);
                }

                return array_merge($this->results, [
                    'result' => true,
                    'message' => trans('code/source.update.success'),
                ]);
            });
        } catch (Exception $e) {
            $exception = array_merge($this->results, [
                'result' => false,
                'message' => $this->handler($e, trans('code/source.update.fail')),
            ]);
        }

        return array_merge($this->results, $exception);
    }

    public function destroy($id)
    {
        try {
            $exception = DB::transaction(function () use ($id) {
                $id = $this->sourceRepo->decodeId($id);
                #删除

                if ($source = $this->sourceRepo->update(['status' => 2], $id)) {
                    #TODO:: other logic
                } else {
                    throw new Exception(trans('code/source.destroy.fail'), 2);
                }

                return array_merge($this->results, [
                    'result' => true,
                    'message' => trans('code/source.destroy.success'),
                ]);
            });
        } catch (Exception $e) {
            $exception = array_merge($this->results, [
                'result' => false,
                'message' => $this->handler($e, trans('code/source.destroy.fail')),
            ]);
        }

        return array_merge($this->results, $exception);
    }

    /**
     * @desc 回收
     * @param $id
     * @return array
     */
    public function recycling($id){
        try {
            $exception = DB::transaction(function () use ($id) {
                $id = $this->sourceRepo->decodeId($id);
                # 回收分发，即把状态改为1，未分发状态
                if ($source = $this->sourceRepo->update(['issue' => 1], $id)) {
                    #TODO:: other logic

                    event(new \App\Events\Report\Task\Delete($source->id));
                } else {
                    throw new Exception(trans('code/source.recycling.fail'), 2);
                }

                return array_merge($this->results, [
                    'result' => true,
                    'message' => trans('code/source.recycling.success'),
                ]);
            });
        } catch (Exception $e) {
            $exception = array_merge($this->results, [
                'result' => false,
                'message' => $this->handler($e, trans('code/source.recycling.fail')),
            ]);
        }

        return array_merge($this->results, $exception);
    }

    /**
     * @desc 分发
     * @param $id
     * @return array
     */
    public function issue($id){
        try {
            $exception = DB::transaction(function () use ($id) {
                $id = $this->sourceRepo->decodeId($id);
                # 分发，即把状态改为2，已分发状态
                if ($source = $this->sourceRepo->update(['issue' => 2], $id)) {
                    $data = request()->all();
                    $taskUserId = $this->userRepo->decodeId($data['uid']);
                    $regulation = $this->regulaRepo->getRegulationsBySeverity(getCompanyId(),$data['severity']);
                    #TODO::事件触发
                    event(new \App\Events\Report\Task\Assign($taskUserId, $source, $regulation));
                } else {
                    throw new Exception(trans('code/source.issue.fail'), 2);
                }

                return array_merge($this->results, [
                    'result' => true,
                    'message' => trans('code/source.issue.success'),
                ]);
            });
        } catch (Exception $e) {
            $exception = array_merge($this->results, [
                'result' => false,
                'message' => $this->handler($e, trans('code/source.issue.fail')),
            ]);
        }

        return array_merge($this->results, $exception);
    }

    public function issueCreate($id)
    {
        try {
            $id = $this->sourceRepo->decodeId($id);
            $source = $this->sourceRepo->find($id);
            if(empty($source)) throw new Exception(trans('code/source.issueCreate.source_no_exists'));
            #严重性
            $severity = $this->hasManyDictionaries(['报告严重性']);

            #录入人员
            $organize_value = getRoleOrganizeValue('source_manager');
            $data_insert_users = $this->nextNodeUsers($organize_value);
            return [
                'id' => $id,
                'severity' => $severity,
                'data_insert_users' => $data_insert_users,
            ];
        } catch (Exception $e) {
            abort(404);
        }
    }

    /**
     * @desc 下载
     * @param $id
     * @return array
     */
    public function download($id){
        try {
            $exception = DB::transaction(function () use ($id) {
                $id = $this->sourceRepo->decodeId($id);

                if ($source = $this->sourceRepo->update(['issue' => 2], $id)) {
                    #TODO:: other logic
                } else {
                    throw new Exception(trans('code/source.download.fail'), 2);
                }

                return array_merge($this->results, [
                    'result' => true,
                    'message' => trans('code/source.download.success'),
                ]);
            });
        } catch (Exception $e) {
            $exception = array_merge($this->results, [
                'result' => false,
                'message' => $this->handler($e, trans('code/source.download.fail')),
            ]);
        }

        return array_merge($this->results, $exception);
    }






}