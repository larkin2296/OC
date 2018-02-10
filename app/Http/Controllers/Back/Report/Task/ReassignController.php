<?php

namespace App\Http\Controllers\Back\Report\Task;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ControllerTrait;
use App\Traits\EncryptTrait;
use App\Services\Report\Task\ReassignService as Service;

class ReassignController extends Controller
{
    use ControllerTrait;

	use EncryptTrait;

	/*模板文件夹*/
    protected $folder = 'back.report.task.reassign';

    protected $routePrefix = 'admin.report.task.reassign';

    protected $encryptConnection = 'reporttask';

    protected $service;

    public function __construct(Service $service)
    {
    	$this->service = $service;
    }

    public function index($id)
    {

    	$results = $this->service->index($id);
           
    	return view(getThemeTemplate($this->folder . '.index'))->with($results);
    }
    /**
     * 报告任务重新分发
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function store($id)
    {
    	$results = $this->service->store($id);

    	return response()->json($results);
    }
}
