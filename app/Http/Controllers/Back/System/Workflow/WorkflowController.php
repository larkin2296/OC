<?php

namespace App\Http\Controllers\Back\System\Workflow;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ControllerTrait;
use App\Services\WorkflowService as Service;

class WorkflowController extends Controller
{
	use ControllerTrait;

	/*模板文件夹*/
    protected $folder = 'back.system.workflow';
    protected $routePrefix = 'admin.workflow';
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
     * 工作流配置
     * @return [type] [description]
     */
    public function setting($id)
    {
        $results = $this->service->setting($id);

        return view(getThemeTemplate($this->folder . '.setting'))->with($results);
    }

    /**
     * 启用工作流
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function open($id)
    {
        $results = $this->service->open($id);

        return response()->json($results);

    }
}
