<?php

namespace App\Http\Controllers\Card\Purchasing;

use App\Http\Controllers\Controller;
use App\Traits\ControllerTrait;
use App\Traits\EncryptTrait;
use Illuminate\Validation\Rule;
use App\Services\OcService\CamiloRechargeService as Service;


class CamiloRechargeController extends Controller
{
    protected $service;
    public function __construct(Service $service)
    {
        $this->service = $service;
    }
    public function index(){
        $result['goods_type'] = $this->service->search(array('status'=>'0'));
        return view('themes.metronic.ocback.backstage.purchasing.camilorecharge')->with($result);
    }
}
