<?php

namespace App\Http\Controllers\Back\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ControllerTrait;
use App\Traits\EncryptTrait;
use App\Services\Report\TaskService as Service;

class TaskController extends Controller
{
    use ControllerTrait;

	use EncryptTrait;

	/*模板文件夹*/
    protected $folder = 'back.report.task';

    protected $routePrefix = 'admin.report.task';

    protected $encryptConnection = 'reporttask';

    protected $service;

    public function __construct(Service $service)
    {
    	$this->service = $service;
    }

    /**
     * 用户列表
     * @return [type] [description]
     */
    public function index()
    {
    	if( request()->ajax() ) {
    		return $this->service->datatables();
    	} else {
    		$results = $this->service->index();

	        return view(getThemeTemplate($this->folder . '.index'))->with($results);
    	}
    }

    /**
     * 报告任务重新分发
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function reassignCreate($id)
    {
    	$results = $this->service->reassignCreate($id);

    	return view(getThemeTemplate($this->folder . '.reassign'))->with($results);
    }
}
