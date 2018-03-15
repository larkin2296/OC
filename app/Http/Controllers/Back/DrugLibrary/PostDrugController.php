<?php
/**
 * Created by PhpStorm.
 * User: xinxin.lv
 * Date: 2018/1/16
 * Time: 上午11:06
 */
namespace App\Http\Controllers\Back\DrugLibrary;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ControllerTrait;
use App\Services\DrugLibraryService as Service;
use Illuminate\Validation\Rule;

class PostDrugController extends Controller
{
    use ControllerTrait;

    /*模板文件夹*/
    protected $folder = 'back.drug-library';
    protected $routePrefix = 'admin.postdrug';
    protected $routeHighLightPrefix = 'admin.postdrug';

    protected $service;
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * 上市后药品列表
     * @return [type] [description]
     */
    public function postIndex()
    {
        if( request()->ajax() ) {
            return $this->service->datatables();
        } else {
            $results = $this->service->index();

            return view(getThemeTemplate($this->folder . '.postIndex'))->with($results);
        }
    }
    /**
     * 上市后药品信息创建 
     * @return [type] [description]
     */
    public function postCreate()
    {
        $this->routeHighLightPrefix = 'admin.postdrug';
        $info = $this->service->create();
        return view(getThemeTemplate($this->folder . '.postCreate'))->with($info);
    }
    /**
     * 修改药品信息
     * @return [type] [description]
     */
    public function postEdit()
    {
        $info = $this->service->edit(request('id'));
        return view(getThemeTemplate($this->folder . '.postEdit'))->with($info);
    }
    /**
     * 删除药品
     * @return [type] [description]
     */
    public function remove()
    {
        return $this->service->destroy(request('id'));
    }

    private function storeRules(){
        $type = \request('type');
        #上市前
        if($type == 1){
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
        if($type == 2){
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

    private function updateRules(){
        $type = \request('type');
        #上市前
        if($type == 1){
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
        if($type == 2){
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