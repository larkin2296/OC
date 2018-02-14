<?php
namespace App\Services;
use App\Repositories\Models\Source;
use App\Services\Service as BasicService;
use Yajra\DataTables\Html\Builder;
use App\Traits\ResultTrait;
use App\Traits\ExceptionTrait;
use App\Traits\ServiceTrait;
use DataTables;
use Exception;
use DB;

Class ManagementService extends Service
{
    use ServiceTrait, ResultTrait, ExceptionTrait;

    public function __construct(Builder $builder)
    {
        parent::__construct();
        $this->builder = $builder;
    }

    public function datatables()
    {
        $searchFields = [
            'oc_number' => 'like',
            'name' => 'like',
            'status' => '=',
            'card_number' => 'like',
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

    public function index()
    {
        $html = $this->builder->columns([
            ['data' => 'oc_number', 'name' => 'oc_number', 'title' => '油卡编号', 'class' => 'text-center'],
            ['data' => 'card_number', 'name' => 'card_number', 'title' => '油卡号', 'class' => 'text-center'],
            ['data' => 'name', 'name' => 'name', 'title' => '用户名', 'class' => 'text-center'],
            // ['data' => 'operation_id', 'name' => 'operation_id', 'title' => 'operation_id'],
            ['data' => 'status', 'name' => 'status', 'title' => '状态', 'class' => 'text-center'],

        ])
            ->ajax([
                'url' => route('admin.management.index'),
                'type' => 'GET',
            ])->parameters(config('back.datatables-cfg.basic'));
        return [
            'html' => $html
        ];
    }

    /*添加*/
    public function create()
    {
        try {
            $exception = DB::transaction(function () {
                if ($info = $this->managementRepo->create(request()->all())) {
                } else {
                    throw new Exception(trans('code/management.create.fail'), 2);
                }

                return array_merge($this->results, [
                    'result' => true,
                    'message' => trans('code/management.create.success'),
                ]);
            });
        } catch (Exception $e) {
            $exception = array_merge($this->results, [
                'result' => false,
                'message' => $this->handler($e, trans('code/management.create.fail')),
            ]);
        }
        return array_merge($this->results, $exception);
    }
    /*油卡删除*/
    public function destroy($id)
    {
        try {
            $exception = DB::transaction(function() use ($id) {

                if( $info = $this->managementRepo->delete($id) ){
                    /*删除油卡关联事件*/
                } else {
                    throw new Exception(trans('code/management.destroy.fail'), 2);
                }

                return array_merge($this->results, [
                    'result' => true,
                    'message' => trans('code/management.destroy.success'),
                ]);
            });
        } catch (Exception $e) {
            $exception = array_merge($this->results, [
                'result' => false,
                'message' => $this->handler($e, trans('code/management.destroy.fail')),
            ]);
        }

        return array_merge($this->results, $exception);
    }
    /*油卡状态更改*/
    public function update($id)
    {
        try {
            $exception = DB::transaction(function() use ($id) {

                if( $info = $this->managementRepo->find($id)) {
                    if($info->status == 1)
                    {
                        $info = $this->managementRepo->update(['status'=>0],$id);
                    } else{
                        $info = $this->managementRepo->update(['status'=>1],$id);

                    }
                } else {
                    throw new Exception(trans('code/management.update.fail'), 2);
                }

                return array_merge($this->results, [
                    'result' => true,
                    'message' => trans('code/management.update.success'),
                ]);
            });
        } catch (Exception $e) {
            $exception = array_merge($this->results, [
                'result' => false,
                'message' => $this->handler($e, trans('code/management.update.fail')),
            ]);
        }

        return array_merge($this->results, $exception);
    }
}