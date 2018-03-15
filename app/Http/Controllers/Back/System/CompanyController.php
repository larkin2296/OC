<?php

namespace App\Http\Controllers\Back\System;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ControllerTrait;
use App\Services\MenuService as Service;

class CompanyController extends Controller
{
    use ControllerTrait;

    /*模板文件夹*/
    protected $folder = 'back.system.company';
    protected $routePrefix = 'admin.company';

    public function __construct(Service $service)
    {
    	$this->service = $service;
    }

    /**
     * 切换公司
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function exchange($id)
    {
    	// return view(getThemeTemplate($this->folder . '.exchange'));
        return redirect()->route('admin.dash.index');
    }
}
