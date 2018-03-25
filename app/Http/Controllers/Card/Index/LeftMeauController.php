<?php

namespace App\Http\Controllers\Card\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LeftMeauController extends Controller
{
    public function index(){
      //  dd(13);
        return view('themes.metronic.ocback.backstage.purchasing.left_meau');
    }
}
