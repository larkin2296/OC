<?php
/**
 * Created by PhpStorm.
 * User: xinxin.lv
 * Date: 2018/1/16
 * Time: 上午11:35
 */

namespace App\Services;

use App\Traits\ResultTrait;
use App\Traits\ExceptionTrait;
use App\Traits\ServiceTrait;
use Exception;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\DataTables;
use DB;

class DrugLibraryService extends Service
{
    use ServiceTrait, ResultTrait, ExceptionTrait;

    protected $builder;

    public function __construct(Builder $builder)
    {
        parent::__construct();
        $this->builder = $builder;
    }

    public function store()
    {
        $data = request()->all();
        $data['company_id'] = getCompanyId();
        try {
            $exception = DB::transaction(function () use ($data) {

                if ($drug = $this->drugRepo->create($data)) {
                    # TODO:: exec other logic
                } else {
                    throw new Exception(trans('code/drug.store.fail'), 2);
                }

                return array_merge($this->results, [
                    'result' => true,
                    'message' => trans('code/drug.store.success'),
                ]);
            });
        } catch (Exception $e) {
            $exception = array_merge($this->results, [
                'result' => false,
                'message' => $this->handler($e, trans('code/drug.store.fail')),
            ]);
        }
        return array_merge($this->results, $exception);
    }

    public function datatables()
    {
        $type = request()->type;
        $model = $this->drugRepo->makeModel();
        $model = $model->type($type);
        $model = $model->status(1);

        if($type == 2){
            return DataTables::of($model)
            ->editColumn('drug_id', '{{ $id_hash }}')
            ->addColumn('action', getThemeTemplate('back.drug-library.pre-datatable'))
            ->make();
        }else{
            return DataTables::of($model)
            ->editColumn('drug_id', '{{ $id_hash }}')
            ->addColumn('action', getThemeTemplate('back.drug-library.post-datatable'))
            ->make();
        }
    }

    public function index($type = 1)
    {
        if ($type == 1) { #上市前
            $html = $this->builder->columns([
                ['data' => 'active_ingredients', 'name' => 'active_ingredients', 'title' => '活性成份'],
                ['data' => 'common_zh_name', 'name' => 'common_zh_name', 'title' => '通用名称'],
                ['data' => 'manufacturer', 'name' => 'manufacturer', 'title' => '生产厂家'],
                ['data' => 'formulation', 'name' => 'formulation', 'title' => '剂型'],
                ['data' => 'action', 'name' => 'action', 'title' => '操作', 'class' => 'text-center', 'sorting' => false],
            ])

            ->ajax([
                'url' => route('admin.predrug.index'),
                'type' => 'GET',
                'data'=> 'function(d) { d.type = '.$type.'; }',
            ])->parameters(config('back.datatables-cfg.basic'));
        }
        else{ #上市后
            $html = $this->builder->columns([
                ['data' => 'product_en_name', 'name' => 'product_en_name', 'title' => '商品名称'],
                ['data' => 'common_zh_name', 'name' => 'common_zh_name', 'title' => '通用名称'],
                ['data' => 'approval_number', 'name' => 'approval_number', 'title' => '批号'],
                ['data' => 'drug_class', 'name' => 'drug_class', 'title' => '药品分类', 'class' => 'text-center'],
                ['data' => 'manufacturer', 'name' => 'manufacturer', 'title' => '生产厂家'],
                ['data' => 'is_import', 'name' => 'is_import', 'title' => '国产/进口'],
                ['data' => 'adverse_reactions', 'name' => 'adverse_reactions', 'title' => '不良反应'],
                ['data' => 'action', 'name' => 'action', 'title' => '操作', 'class' => 'text-center', 'sorting' => false],
            ])

            ->ajax([
                'url' => route('admin.postdrug.index'),
                'type' => 'GET',
                'data'=> 'function(d) { d.type = '.$type.'; }',
            ])->parameters(config('back.datatables-cfg.basic'));
        }

        return [
            'html' => $html
        ];
    }

    public function create()
    {
        #药品分类
        $drugClass = getDrugClass();
        #进口 || 国产
        $drugImport = drugImport();
        #剂型
        $formulation = formulation();
        #给药企途径
        $medicationWay = medicationWay();
        #通用验证
        $commonChecks = getCommonCheck();

        return [
            'drugClass' => $drugClass,
            'drugImport' => $drugImport,
            'formulation' => $formulation,
            'medicationWay' => $medicationWay,
            'commonChecks' => $commonChecks
        ];
    }

    public function edit($id)
    {
        try {
            #获取某个药品
            $id = $this->drugRepo->decodeId($id);
            $drug = $this->drugRepo->find($id);

            #药品分类
            $drugClass = getDrugClass();
            #进口 || 国产
            $drugImport = drugImport();
            #剂型
            $formulation = formulation();
            #给药企途径
            $medicationWay = medicationWay();
            #通用验证
            $commonChecks = getCommonCheck();


            return [
                'drug' => $drug,
                'drugClass' => $drugClass,
                'drugImport' => $drugImport,
                'formulation' => $formulation,
                'medicationWay' => $medicationWay,
                'commonChecks' => $commonChecks
            ];
        } catch (Exception $e) {

            abort(404);
        }
    }

    /**
     * 修改保存
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function update($id)
    {

        try {
            $exception = DB::transaction(function () use ($id) {
                $id = $this->drugRepo->decodeId($id);
                $data = request()->all();
//                $data = array(
//                    'common_zh_name' => '头孢1',
//                    'common_en_name' => 'toubao1',
//                    'common_standard_name' => '头孢那什么',
//                    'active_ingredients' => '当归',
//                    'drug_class' => '1',
//                    'manufacturer' => '上海拜耳制药',
//                    'formulation' => '口服',
//                    'type' => '1'
//                );

                if ($drug = $this->drugRepo->update($data, $id)) {
                    #TODO:: exec other logic
                } else {
                    throw new Exception(trans('code/drug.update.fail'), 2);
                }

                return array_merge($this->results, [
                    'result' => true,
                    'message' => trans('code/drug.update.success'),
                ]);
            });
        } catch (Exception $e) {
            $exception = array_merge($this->results, [
                'result' => false,
                'message' => $this->handler($e, trans('code/drug.update.fail')),
            ]);
        }

        return array_merge($this->results, $exception);
    }

    /**
     * 删除药品
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function destroy($id)
    {
        try {
            $exception = DB::transaction(function () use ($id) {
                $id = $this->drugRepo->decodeId($id);
                #删除

                if ($drug = $this->drugRepo->update(['status' => 2], $id)) {

                } else {
                    throw new Exception(trans('code/drug.destroy.fail'), 2);
                }

                return array_merge($this->results, [
                    'result' => true,
                    'message' => trans('code/drug.destroy.success'),
                ]);
            });
        } catch (Exception $e) {
            $exception = array_merge($this->results, [
                'result' => false,
                'message' => $this->handler($e, trans('code/drug.destroy.fail')),
            ]);
        }

        return array_merge($this->results, $exception);
    }


}