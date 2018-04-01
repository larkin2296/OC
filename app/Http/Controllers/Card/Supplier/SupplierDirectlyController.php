<?php

namespace App\Http\Controllers\Card\Supplier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\OcService\SupplierDirectlyService as Service;

class SupplierDirectlyController extends Controller
{
    protected $service;
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function index(){
        $results=$this->service->get_config_blade(config('oc.supplier.supplierdirectly'));
        $results['data'] = '';
        return view('themes.metronic.ocback.backstage.supplier.supplierdirectly')->with($results);
    }
    public function search(){

        $results=$this->service->search();
        return response()->json($results);
    }
}
