<?php

namespace App\Http\Controllers\Card\Supplier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\OcService\SupplierListService as Service;

class SupplierListController extends Controller
{
    protected $service;
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function index(){
        $results=$this->service->get_config_blade(config('oc.supplier.supplierlist'));
        $results['data'] = '';
        return view('themes.metronic.ocback.backstage.supplier.supplierlist')->with($results);
    }
    public function search(){

        $results=$this->service->search();
        return response()->json($results);
    }
}
