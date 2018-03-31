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
    public function create(Request $request){
        $this->service->create();
        return redirect('/admin/backstage/oil_binding/index');
    }
    public function view(){
        $results=$this->service->get_config_blade(config('oc.default.oilcardbinding'));
        $results['data'] = $this->get_data();
        return view('themes.metronic.ocback.backstage.purchasing.oilcardbinding')->with($results);
    }
    public function get_data(){
        return $results=$this->service->search(array('user_id'=>request()->user()->id));
    }
}
