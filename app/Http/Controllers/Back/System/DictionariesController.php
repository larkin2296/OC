<?php
namespace App\Http\Controllers\Back\System;
use App\Events\Dictionaries\Dictionaries;
use App\Traits\EncryptTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ControllerTrait;
use App\Services\DictionariesService as Service;
//use App\Repositories\Models\Dictionaries;
Class DictionariesController extends Controller
{
    use EncryptTrait;

    use ControllerTrait;
    /*模板文件夹*/
    protected $folder = 'back.system.Dictionaries';
     /*定义路由*/
    protected $routePrefix = 'admin.Diction';

    protected $encryptConnection = 'dictionaries';
    /*service*/
    protected $service;
    /*构造函数*/
    public function __construct(Service $service)
    {
        $this->service = $service;
    }
    /**
     * 字典列表
     * @return [type] [description]
     */
      public function index()
      {
          if( request()->ajax() ) {
              return $this->service->datatables();
          } else {
              $results = $this->service->index();

              return view(getThemeTemplate($this->folder  . '.index'))->with($results);
          }
      }
    /**
     * 新增字典
     * @return [type]data id [description]
     */
        public function create()
      {
        $result = $this->service->create();
        return response()->json($result);
      }
    /**
     * 子列表
     * @return [type] id [description]
     */
    public function show($id)
    {
        $results = $this->service->show($id);
        return response()->json($results);
    }
    /**
     * 编辑子列表
     * @return [type] id [description]
     */
      public function edit($id)
      {
          $results = $this->service->edit($id);
          return view(getThemeTemplate($this->folder . '.edit'))->with($results);
      }
    /**
     * 删除子列表
     * @return [type] id [description]
     */
      public function destroy($id)
      {
          $results = $this->service->destroy($id);
          return response()->json($results);
      }
    /**
     * 修改子列表数据
     * @return [type]data id [description]
     */
    public function update($id)
    {
        $results = $this->service->update($id);
        return response()->json($results);
    }
    /**
     * 查询所属页面 关键字
     * @return [type]page keyword [description]
     */
      public function search($page=0,$keyWord='null')
      {
       $results = $this->service->search($page,$keyWord);
       return response()->json($results);
      }
       private function storeRules()
       {
        return [
            'name' => [
                'required',
                Rule::unique('dictionaries')->where(function($query) {
                    return $query->whereNull('deleted_at');
                }),
            ],
            'sub_chinese' => 'required',
            'sub_english' => 'required',
            'e_name' => 'required',
            'e_formate' => 'required',
        ];
    }

    private function updateRules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('dictionaries')->where(function($query) {
                    return $query->whereNull('deleted_at');
                })->ignore($this->decodeId(getRouteParam('dictionaries')), 'id'),
            ],
            'sub_chinese' => 'required',
            'sub_english' => 'required',
            'e_name' => 'required',
            'email' => 'required',
            'e_formate' => 'required',
        ];
    }

    private function messages()
    {
        return [

        ];
    }
    /**
     * 字典查询 durg_name b_n/g_n
     * @param  [type] $array    [description]
     * @param  [type]           [description]
     * @return [type]           [description]
     */
    public function hasmanydictionaries()
    {
        $results = $this->service->hasmanydictionaries();
        return response()->json($results);
    }

}