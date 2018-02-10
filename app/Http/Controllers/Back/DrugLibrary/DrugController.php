<?php
/**
 * Created by PhpStorm.
 * User: xinxin.lv
 * Date: 2018/1/16
 * Time: 上午11:06
 */

namespace App\Http\Controllers\Back\DrugLibrary;

use App\Http\Controllers\Controller;
use App\Traits\ControllerTrait;
use App\Services\DrugLibraryService as Service;

class DrugController extends Controller
{
    use ControllerTrait;

    /*模板文件夹*/
    protected $folder = 'back.drug-library';
    protected $routePrefix = 'admin.drug';
    protected $routeHighLightPrefix = 'admin.predrug';

    protected $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    private function storeRules(){
        $type = \request('type');
        #上市前
        if ($type == 1) {
            return [
                'common_zh_name' => 'required',
                'common_en_name' => 'required',
                'common_standard_name' => 'required',
                'active_ingredients' => 'required',
                'drug_class' => 'required',
                'manufacturer' => 'required',
                'formulation' => 'required',
            ];
        }
        #上市后
        if ($type == 2) {
            # TODO:: 原型上没有具体标，暂不处理
            return [
                'approval_number' => 'required',
                'product_en_name' => 'required',
                'product_zh_name' => 'required',
                'common_zh_name' => 'required',
                'common_en_name' => 'required',
                'common_standard_name' => 'required',
                'active_ingredients' => 'required',
                'drug_class' => 'required',
                'manufacturer' => 'required',
                'formulation' => 'required',
            ];
        }


    }

    private function updateRules()
    {
        $type = \request('type');
        #上市前
        if ($type == 1) {
            return [
                'common_zh_name' => 'required',
                'common_en_name' => 'required',
                'common_standard_name' => 'required',
                'active_ingredients' => 'required',
                'drug_class' => 'required',
                'manufacturer' => 'required',
                'formulation' => 'required',
            ];
        }
        #上市后
        if ($type == 2) {
            # TODO:: 原型上没有具体标，暂不处理
            return [
                'approval_number' => 'required',
                'product_en_name' => 'required',
                'product_zh_name' => 'required',
                'common_zh_name' => 'required',
                'common_en_name' => 'required',
                'common_standard_name' => 'required',
                'active_ingredients' => 'required',
                'drug_class' => 'required',
                'manufacturer' => 'required',
                'formulation' => 'required',
            ];
        }
    }

    private function messages()
    {
        return [
            'common_zh_name.required' => '通用中文名称不能为空',
            'common_en_name.required' => '通用英文名称不能为空',
            'common_standard_name.required' => '标准通用名称不能为空',
            'active_ingredients.required' => '活性成份不能为空',
            'drug_class.required' => '药品分类不能为空',
            'manufacturer.required' => '生产厂家不能为空',
            'formulation.required' => '剂型不能为空',
        ];
    }


}