<?php

namespace App\Http\Controllers\Back\Report;

use App\Http\Controllers\Controller;
use App\Traits\ControllerTrait;
use App\Services\Report\LogisticsService as Service;
/**
 * Class LogisticsController.
 *
 * @package namespace App\Http\Controllers;
 */
class LogisticsController extends Controller
{
    use ControllerTrait;

    /*模板文件夹*/
    protected $folder = 'back.report.logistics';
    protected $routePrefix = 'admin.logistics';

    protected $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function lists($id){
        $results = $this->service->index();
        return view(getThemeTemplate($this->folder . '.index'))->with($results);
    }


}
