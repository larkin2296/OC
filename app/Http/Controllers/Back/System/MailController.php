<?php

namespace App\Http\Controllers\Back\System;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ControllerTrait;
use App\Traits\EncryptTrait;
use App\Services\MailService as Service;
use Illuminate\Validation\Rule;

class MailController extends Controller
{
    use ControllerTrait;

    use EncryptTrait;
    /*模板文件夹*/
    protected $folder = 'back.system.mail';
    /*路由*/
    protected $routePrefix = 'admin.mail';

    protected $encryptConnection = 'mail';

    protected $service;

    public function __construct(Service $service)
    {
        $this->service = $service;

        $this->setEncryptConnection($this->encryptConnection);
    }
    /*添加页面*/
    public function index()
    {
        if(request()->ajax())
        {
            return view(getThemeTemplate($this->folder . '.index'));
        }
    }
    /*添加数据*/
    public function create()
    {
        $results = $this->service->create();

        return response()->json($results);
    }
}