<?php
namespace App\Services;
use App\Repositories\Models\Subdictionaries;
use App\Services\Service as BasicService;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use App\Traits\ResultTrait;
use App\Traits\ExceptionTrait;
use App\Traits\ServiceTrait;
use Yajra\DataTables\DataTables;
use Exception;
use DB;
use App\Repositories\Models\Dictionaries;
Class DictionariesService extends BasicService{
    //ResultTrait返回字段  ExceptionTrait 例外    ServiceTrait 限制
    use ResultTrait , ExceptionTrait , ServiceTrait;
    //使用Builder插件
    public function __construct(Builder $builder)
    {
        parent::__construct();
        $this->builder = $builder;
    }
    public function builder()
    {
        $info = $this->questionRepo->all();
        return $info;
    }
      /*ajax请求*/
     public function datatables()
     {
         $data = $this->dictionariesRepo->all();
         return DataTables::of($data)
             ->addColumn('action', getThemeTemplate('back.system.dictionaries.datatable'))
             ->make();
     }
     public function index()
     {
         $html = $this->builder->columns([
             ['data' => 'serial', 'name' => 'serial', 'title' => '序号'],
             ['data' => 'chinese', 'name' => 'chinese', 'title' => '中文'],
             ['data' => 'forpage', 'name' => 'forpage', 'title' => '所属页面'],
             ['data' => 'structure', 'name' => 'structure', 'title' => '系统构件'],
             ['data' => 'action', 'name' => 'action', 'title' => '操作', 'class' => 'text-center', 'sorting' => false]
         ])
             ->ajax([
                 'url' => route('admin.dictionaries.index'),
                 'type' => 'GET',
             ])->parameters(config('back.datatables-cfg.basic'));
         return [
             'html' => $html
         ];

     }
     /*编辑*/
    public function edit($id)
    {
        try {
            /*获取字典信息*/
            $subdictionaries_info = $this->subdictionariesRepo->find($id);
            return [
                'subdictionaries'=>  $subdictionaries_info,
            ];
        } catch (Exception $e) {
            abort(404);
        }
    }
    /*修改*/
    public function update($id)
    {
        try {
            $exception = DB::transaction(function() use ($id) {

                if( $info = $this->subdictionariesRepo->update(request()->all(), $id) ) {
                } else {
                    throw new Exception(trans('code/subdictionaries.update.fail'), 2);
                }

                return array_merge($this->results, [
                    'result' => true,
                    'message' => trans('code/subdictionaries.update.success'),
                ]);
            });
        } catch (Exception $e) {
            $exception = array_merge($this->results, [
                'result' => false,
                'message' => $this->handler($e, trans('code/subdictionaries.update.fail')),
            ]);
        }

        return array_merge($this->results, $exception);
    }
    /*删除*/
    public function destroy($id)
    {
        try {
            $exception = DB::transaction(function() use ($id) {

                if( $info = $this->subdictionariesRepo->delete($id) ){
                    event(new \App\Events\Dictionaries\dele($id));
                } else {
                    throw new Exception(trans('code/dictionaries.destroy.fail'), 2);
                }

                return array_merge($this->results, [
                    'result' => true,
                    'message' => trans('code/dictionaries.destroy.success'),
                ]);
            });
        } catch (Exception $e) {
            $exception = array_merge($this->results, [
                'result' => false,
                'message' => $this->handler($e, trans('code/dictionaries.destroy.fail')),
            ]);
        }

        return array_merge($this->results, $exception);
    }
   /*所属页面*/
   public function search($page,$keyword)
   {
       try {
           if($page==0&&$keyword=='null'){$datas = $this->dictionariesRepo->all();}
           else{
               if($page!=0&&$keyword=='null'){$datas = $this->dictionariesRepo->findWhere(['forpage'=>$page])->all();}else{
                   if($page==0&&$keyword!='null'){$datas = $this->dictionariesRepo->findWhere([['chinese','like',"%{$keyword}%"]])->all();}else{
                       $datas = $this->dictionariesRepo->findWhere(['forpage' => $page, ['chinese', 'like', "%{$keyword}%"]])->all();
                   }
               }
           }
           $results = array_merge($this->results, [
               'result' => true,
               'data' => $datas,
               'message' => trans('code/dictionaries.search.success'),
           ]);
       } catch (Exception $e) {
           $results = array_merge($this->results, [
               'result' => false,
               'data' => $this->handler($e, trans('code/dictionaries.search.fail')),
           ]);
       }

       return array_merge($this->results, $results);
   }
    /*新增*/
    public function create()
    {
        try {
           $exception = DB::transaction(function() {
               if( $info = $this->subdictionariesRepo->create(request()->all())){
               } else {
                   throw new Exception(trans('code/subdictionaries.create.fail'), 2);
               }

               return array_merge($this->results, [
                   'result' => true,
                   'message' => trans('code/subdictionaries.create.success'),
               ]);
           });
       } catch (Exception $e) {
           $exception = array_merge($this->results, [
               'result' => false,
               'message' => $this->handler($e, trans('code/subdictionaries.create.fail')),
           ]);
       }

       return array_merge($this->results, $exception);
    }

   /*字段编辑*/
   public function show($id)
   {
       try {
           $exception = DB::transaction(function() use ($id){
                $datas = $this->subdictionariesRepo->findWhereIn('dict_id',[$id])->map(function($item, $key){
                    $item->delete = route('admin.dictionaries.destroy', $item->id);
                    $item->edit = route('admin.dictionaries.edit', $item->id);
                    return $item;
                });
               return array_merge($this->results, [
                   'result' => true,
                   'data'=>$datas,
                   'message' => trans('code/subdictionaries.field.success')
               ]);
           });
       } catch (Exception $e) {
           $exception = array_merge($this->results, [
               'result' => false,
               'message' => $this->handler($e, trans('code/subdictionaries.field.fail')),
           ]);
       }

       return array_merge($this->results, $exception);
   }
   /*字典全局接口*/
    public function hasmanydictionaries()
    {
        try {
            $exception = DB::transaction(function(){
//                $results = ['chinese'=>'国家','chinese'=>'企业报告类型'];
//                $results = [
//                  ['chinese'=>'国家'],
//                  ['chinese'=>'企业报告类型'],
//                ];
//                $results = ['chinese' => [
//                    '0' => '国家',
//                    '1' => '企业报告类型'
//                ]];
//               array(1) { ["chinese"]=> array(2) { [0]=> string(6) "国家" [1]=> string(18) "企业报告类型" } }

                $results = request()->all();

                if (is_array($results)) {

                    $dictionaries = new Dictionaries();
                    $newData = array();

                   foreach($results['chinese'] as $k=>$item) {
                    $data = $dictionaries::where('chinese',$item)->select('id')->get();
                       foreach($data as $key=>$val){
                           $newData[$item] = $this->subdictionariesRepo->findWhere(['dict_id'=>$val['id']])->all();
                      }
                   }
                      /*闭包*/
//                    $data = $data->each(function ($item,$key) {
//                       $item->data;
//                    })->toArray();
                }
                else
                {
                    return false;
                }
                return array_merge($this->results, [
                    'result' => true,
                    'data' => $newData,
                    'message' => trans('code/hasmanydictionaries.field.success')
                ]);
            });
        } catch (Exception $e) {
            $exception = array_merge($this->results, [
                'result' => false,
                'message' => $this->handler($e, trans('code/hasmanydictionaries.field.fail')),
            ]);
        }
        return array_merge($this->results, $exception);
    }

}



?>