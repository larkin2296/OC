<?php

namespace App\Http\Controllers\Back\Basic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ControllerTrait;
use App\Traits\EncryptTrait;
use App\Traits\ModelTrait;
use App\Services\EnterpriseService as Service;
use Illuminate\Validation\Rule;

class EnterpriseController extends Controller
{
    use ControllerTrait;

    use EncryptTrait;
    /*模板文件夹*/
    protected $folder = 'back.basic.enterprise';

    protected $routePrefix = 'admin.basic';

    protected $encryptConnection = 'basic';

    protected $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return $this->service->datatables();
//
//        if( request()->ajax() ) {
//            return $this->service->datatables($sourceId);
//        } else {
//            $results = $this->service->index();
//
//            return view(getThemeTemplate($this->folder  . '.index'))->with($results);
//        }

    }

}