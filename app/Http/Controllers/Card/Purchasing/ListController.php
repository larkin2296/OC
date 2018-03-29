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
        $results=$this->service->get_config_blade(config('oc.default.list'));
        //dd($results);
        return view('themes.metronic.ocback.backstage.purchasing.list')->with($results);
    }
    public function search(){

        $results=$this->service->search();
        return response()->json($results);
    }
}
