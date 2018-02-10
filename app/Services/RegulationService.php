<?php
/**
 * Created by PhpStorm.
 * User: xinxin.lv
 * Date: 2018/1/18
 * Time: 下午7:17
 */

namespace App\Services;

use App\Traits\QueueTrait;
use App\Traits\ResultTrait;
use App\Traits\ExceptionTrait;
use App\Traits\ServiceTrait;
use Exception;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\DataTables;
use DB;

class RegulationService extends Service
{
    use ServiceTrait,ResultTrait,ExceptionTrait,QueueTrait;
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
        try {
            $exception = DB::transaction(function () use ($data) {

                if ($regulation = $this->regulaRepo->create($data)) {
                    # TODO:: exec other logic
                } else {
                    throw new Exception(trans('code/regulation.store.fail'), 2);
                }

                return array_merge($this->results, [
                    'result' => true,
                    'message' => trans('code/regulation.store.success'),
                ]);
            });
        } catch (Exception $e) {
            $exception = array_merge($this->results, [
                'result' => false,
                'message' => $this->handler($e, trans('code/regulation.store.fail')),
            ]);
        }
        return array_merge($this->results, $exception);
    }

    public function datatables()
    {
        $model = $this->regulaRepo->makeModel();
        $model = $model->status(1);
        return DataTables::of($model)
            ->editColumn('id', '{{ $id_hash }}')
            ->addColumn('action', getThemeTemplate('back.system.regulation.datatable'))
            ->make();
    }

    public function index()
    {
        //dd($this->regulaRepo->getRegulationsBySeverity(0,1));
        $html = $this->builder->columns([
            ['data' => 'title', 'name' => 'title', 'title' => '规则名称'],
            ['data' => 'severity', 'name' => 'severity', 'title' => '严重性'],
            ['data' => 'priority', 'name' => 'priority', 'title' => '优先级'],
            ['data' => 'updated_at', 'name' => 'updated_at', 'title' => '修改时间'],
            ['data' => 'action', 'name' => 'action', 'title' => '操作', 'class' => 'text-center', 'sorting' => false],
        ])
        ->ajax([
            'url' => route('admin.rule.index'),
            'type' => 'GET',
        ])->parameters(config('back.datatables-cfg.basic'));

        return [
            'html' => $html
        ];


    }

    public function create()
    {

        #严重性
        $severity = severity();

        return [
            'severity' => $severity,
        ];
    }

    public function edit($id)
    {
        try {
            #获取某个规则
            $id = $this->regulaRepo->decodeId($id);
            $regulation = $this->regulaRepo->find($id);

            #严重性
            $severity = severity();

            return [
                'regulation' => $regulation,
                'severity' => $severity,
            ];
        } catch (Exception $e) {

            abort(404);
        }
    }

    public function update($id)
    {

        try {
            $exception = DB::transaction(function () use ($id) {
                $id = $this->regulaRepo->decodeId($id);
                $data = request()->all();


                if ($regulation = $this->regulaRepo->update($data, $id)) {
                    #TODO::修改规则，要更新当前规则下的报告
                    #$this->runRugulationUpdate($regulation);

                } else {
                    throw new Exception(trans('code/regulation.update.fail'), 2);
                }

                return array_merge($this->results, [
                    'result' => true,
                    'message' => trans('code/regulation.update.success'),
                ]);
            });
        } catch (Exception $e) {
            $exception = array_merge($this->results, [
                'result' => false,
                'message' => $this->handler($e, trans('code/regulation.update.fail')),
            ]);
        }

        return array_merge($this->results, $exception);
    }

    public function destroy($id)
    {
        try {
            $exception = DB::transaction(function () use ($id) {
                $id = $this->regulaRepo->decodeId($id);
                #删除

                if ($regulation = $this->regulaRepo->update(['status' => 2], $id)) {
                    #TODO:: 删除规则时，要判断下该规则下的报告，否则，禁止删除
                } else {
                    throw new Exception(trans('code/regulation.destroy.fail'), 2);
                }

                return array_merge($this->results, [
                    'result' => true,
                    'message' => trans('code/regulation.destroy.success'),
                ]);
            });
        } catch (Exception $e) {
            $exception = array_merge($this->results, [
                'result' => false,
                'message' => $this->handler($e, trans('code/regulation.destroy.fail')),
            ]);
        }

        return array_merge($this->results, $exception);
    }
}