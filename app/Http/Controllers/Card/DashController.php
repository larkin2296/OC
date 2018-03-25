<?php

namespace App\Http\Controllers\Card;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ControllerTrait;
use Mockery\Exception;

class DashController extends Controller
{
    use ControllerTrait;

    /*模板文件夹*/
    protected $folder = 'ocback.backstage.index';
    /**/
    protected $routePrefix = 'admin.dash';
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        try{
          // return redirect()->route('create');
             //echo url()->current();
//            return view('themes.metronic.ocback.backstage.purchasing.left_meau');
            return redirect()->route('admin.backstage.p_index');


        //return redirect($url);
        } catch (Exception $e){
            dd($e);
        }
        //dd(route('admin/backstage/p_index'));
       // dd(123);
        //return view(getThemeTemplate($this->folder . '.index'));
    }
}
