<?php

namespace App\Http\Controllers\Back\Report;

use App\Http\Controllers\Controller;
use App\Traits\ControllerTrait;
use App\Services\Report\SourceService as Service;
/**
 * Class SourcesController.
 *
 * @package namespace App\Http\Controllers;
 */
class SourcesController extends Controller
{
    use ControllerTrait;

    /*模板文件夹*/
    protected $folder = 'back.report.source';
    protected $routePrefix = 'admin.source';

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

    public function recycling($id){
        if (request()->ajax()) {
            return $this->service->recycling($id);
        }
        else
        {
            abort(404);
        }
    }

    public function issue($id){

        if(request()->method() == 'POST'){
            if (request()->ajax()) {
                return $this->service->issue($id);
            }
            abort(404);
        }
        else
        {
            $results = $this->service->issueCreate($id);
            return view(getThemeTemplate($this->folder . '.issue'))->with($results);
        }
    }

    public function download($id){
        if (request()->ajax()) {
            return $this->service->download($id);
        }
        else
        {
            abort(404);
        }
    }


}
