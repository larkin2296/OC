<?php

namespace App\Http\Controllers\BackCard\Purchasing;

use Illuminate\Http\Request;

class KamiController extends Controller
{
    public function index(){
        return view('themes/metronic/ocback/backstage/kami');
    }
}
