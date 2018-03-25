<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ControllerTrait;
class HomeController extends Controller
{
    use ControllerTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      //  dd(route('admin.backstage.p_index'));
       //return redirect()->route('admin.backstage.p_index');
    }
}
