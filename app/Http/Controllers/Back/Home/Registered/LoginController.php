<?php
namespace App\Http\Controllers\Back\Home\Registered;

use Illuminate\Http\Request;
use App\Traits\EncryptTrait;
use App\Http\Controllers\Controller;
use App\Traits\ControllerTrait;
use App\Services\LoginService as Service;
class LoginController extends Controller{
    use ControllerTrait;

    use EncryptTrait;
    /*模板文件夹*/
    protected $folder = 'ocback.user';
    /*路由*/
    protected $routePrefix = 'admin.registered';

    protected $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }
    /*展示注册页面*/
    public function index()
    {
        if( request()->ajax() ) {
            return $this->service->datatables();
        } else {
            $results = $this->service->index();
            return view(getThemeTemplate($this->folder  . '.index'))->with($results);
        }

    }
    /*注册用户*/
    public function login()
    {
        $results = $this->service->create();
        return response()->json($results);
    }

}