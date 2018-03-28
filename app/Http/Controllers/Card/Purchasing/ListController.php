<?php

namespace App\Http\Controllers\Card\Purchasing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ServiceTrait;
use App\Services\OcService\ListService as Service;

class ListController extends Controller
{
    protected $service;
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function index(){
       $order_type = config('oc.field.order_type');
        return view('themes.metronic.ocback.backstage.purchasing.list')->with('order_type',$order_type);
    }
    public function search(){

        $results=$this->service->search();
        return response()->json($results);
    }
}
