<?php

namespace App\Http\Controllers\Back\Report;

use App\Http\Controllers\Controller;
use App\Traits\ControllerTrait;
use App\Services\Report\SupervisionsService as Service;
/**
 * Class SourcesController.
 *
 * @package namespace App\Http\Controllers;
 */
class SupervisionsController extends Controller
{
    use ControllerTrait;

    /*模板文件夹*/
    protected $folder = 'back.report.supervision';
    protected $routePrefix = 'admin.supervision';

    protected $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        if (request()->ajax()) {
            return $this->service->datatables();
        } else {
            $results = $this->service->index();

            return view(getThemeTemplate($this->folder . '.index'))->with($results);
        }
    }

    public function immediately($id){
        if (request()->ajax()) {
            return $this->service->immediately($id);
        }
        abort(404);
    }

    public function other(){
        dd(__LINE__);
    }

    public function noNeed(){

    }
}
