<?php

namespace App\Http\Controllers\Card\Purchasing;

use App\Http\Controllers\Controller;
use App\Traits\ControllerTrait;
use App\Traits\EncryptTrait;
use Illuminate\Validation\Rule;
use App\Services\OcService\DirectlyRechargeService as Service;

class DirectlyRechargeController extends Controller
{
    protected $service;
    public function __construct(Service $service)
    {
        $this->service = $service;
    }
    public function index(){
        $results=$this->service->get_config_blade(config('oc.default.directlyrecharge'));
        //dd($results);
        return view('themes.metronic.ocback.backstage.purchasing.directlyrecharge')->with($results);
    }
}
