<?php

namespace App\Http\Controllers\Card\Purchasing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\OcService\OilCardBindingService as Service;

class OilCardBindingController extends Controller
{
    protected $service;
    public function __construct(Service $service)
    {
        $this->service = $service;
    }
    public function index(){
        $this->get_data();
        return $this->view();
    }
    //创建油卡
    public function create(Request $request){
        $this->service->create();
        //重定向到index路由
        return redirect('/admin/backstage/oil_binding/index');
    }
    //获取视图
    public function view(){
        //获取config的配置
        $results=$this->service->get_config_blade(config('oc.default.oilcardbinding'));
        //获取表格数据
        $results['data'] = $this->get_data();
        //获取datatable的字段
        $results['table'] = config('oc.default.oilcardbinding.panel');
        //返回
        return view('themes.metronic.ocback.backstage.purchasing.oilcardbinding')->with($results);
    }
    //获取数据
    public function get_data(){
        //获取关于user_id对应的油卡
        return $results=$this->service->search(array('user_id'=>request()->user()->id));
    }
}
