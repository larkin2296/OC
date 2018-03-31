<?php

namespace App\Http\Controllers\Card\Purchasing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OilCardBindingController extends Controller
{
    public function index(){
        return view('themes.metronic.ocback.backstage.purchasing.oilcardbinding');
    }
    public function create(){

    }
}
