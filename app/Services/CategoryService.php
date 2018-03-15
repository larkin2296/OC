<?php
/**
 * Created by PhpStorm.
 * User: xinxin.lv
 * Date: 2018/1/23
 * Time: 下午4:24
 */

namespace App\Services;

use App\Traits\ResultTrait;
use App\Traits\ExceptionTrait;
use App\Traits\ServiceTrait;
use Exception;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\DataTables;
use DB;

class CategoryService extends Service
{
    use ServiceTrait,ResultTrait,ExceptionTrait;
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

                if ($cate = $this->cateRepo->create($data)) {
                    # TODO:: exec other logic
                } else {
                    throw new Exception(trans('code/category.store.fail'), 2);
                }

                return array_merge($this->results, [
                    'result' => true,
                    'message' => trans('code/category.store.success'),
                ]);
            });
        } catch (Exception $e) {

            $exception = array_merge($this->results, [
                'result' => false,
                'message' => $this->handler($e, trans('code/category.store.fail')),
            ]);
        }
        return array_merge($this->results, $exception);
    }

    public function datatables()
    {
        $model = $this->cateRepo->makeModel();
        $model = $model->status(1);
        return DataTables::of($model)
            ->editColumn('id', '{{ $id_hash }}')
            ->addColumn('action', getThemeTemplate('back.system.cate.datatable'))
            ->make();
    }

    public function index()
    {
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
            ]);

        return [
            'html' => $html
        ];


    }

    public function create()
    {

        #所属模块
        $module = module();

        return [
            'module' => $module,
        ];
    }

    public function edit($id)
    {
        try {
            #获取某个分类
            $id = $this->cateRepo->decodeId($id);
            $cate = $this->cateRepo->find($id);

            #所属模块
            $module = module();


            return [
                'cate' => $cate,
                'module' => $module,
            ];
        } catch (Exception $e) {

            abort(404);
        }
    }

    public function update($id)
    {

        try {
            $exception = DB::transaction(function () use ($id) {
                $id = $this->cateRepo->decodeId($id);
                $data = request()->all();


                if ($cate = $this->cateRepo->update($data, $id)) {
                    #TODO:: exec other logic
                } else {
                    throw new Exception(trans('code/category.update.fail'), 2);
                }

                return array_merge($this->results, [
                    'result' => true,
                    'message' => trans('code/category.update.success'),
                ]);
            });
        } catch (Exception $e) {
            $exception = array_merge($this->results, [
                'result' => false,
                'message' => $this->handler($e, trans('code/category.update.fail')),
            ]);
        }

        return array_merge($this->results, $exception);
    }

    public function destroy($id)
    {
        try {
            $exception = DB::transaction(function () use ($id) {
                $id = $this->cateRepo->decodeId($id);
                #删除

                if ($regulation = $this->cateRepo->update(['status' => 2], $id)) {

                } else {
                    throw new Exception(trans('code/category.destroy.fail'), 2);
                }

                return array_merge($this->results, [
                    'result' => true,
                    'message' => trans('code/category.destroy.success'),
                ]);
            });
        } catch (Exception $e) {
            $exception = array_merge($this->results, [
                'result' => false,
                'message' => $this->handler($e, trans('code/category.destroy.fail')),
            ]);
        }

        return array_merge($this->results, $exception);
    }
}