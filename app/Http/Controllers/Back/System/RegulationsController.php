<?php

namespace App\Http\Controllers\Back\System;

use App\Http\Controllers\Controller;
use App\Traits\ControllerTrait;
use App\Services\RegulationService as Service;
/**
 * Class RegulationsController.
 *
 * @package namespace App\Http\Controllers;
 */
class RegulationsController extends Controller
{

    use ControllerTrait;

    /*模板文件夹*/
    protected $folder = 'back.system.regulation';
    protected $routePrefix = 'admin.rule';

    protected $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * 规则列表
     * @return [type] [description]
     */
    public function index()
    {
        if (request()->ajax()) {
            return $this->service->datatables();
        } else {
            $results = $this->service->index();

            return view(getThemeTemplate($this->folder . '.index'))->with($results);
        }
    }

}
