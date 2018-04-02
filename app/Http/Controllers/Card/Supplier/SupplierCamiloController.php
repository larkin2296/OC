<?php

namespace App\Http\Controllers\Card\Supplier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\OcService\SupplierCamiloService as Service;

class SupplierCamiloController extends Controller
{
    protected $service;
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function get_platform(){
        return $this->service->platform_search(array('status'=>'0'));
    }
    public function index(){
        $results['arr'] = $this->get_platform();
        return view('themes.metronic.ocback.backstage.supplier.suppliercamilo')->with($results);
    }
    public function search(){

        $results=$this->service->search();
        return response()->json($results);
    }
}
