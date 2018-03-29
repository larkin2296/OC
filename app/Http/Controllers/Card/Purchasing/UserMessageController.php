<?php

namespace App\Http\Controllers\Card\Purchasing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserService as Service;

class UserMessageController extends Controller
{
    protected $service;
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function index(){
        $results=$this->service->get_config_blade(config('oc.default.usermessage'));
        //dd($results);
        return view('themes.metronic.ocback.backstage.purchasing.usermessage')->with($results);
    }
}
