<?php

namespace App\Http\Controllers\Back\System\Workflow;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ControllerTrait;
use App\Services\WorkflowNodeService as Service;

class WorkflowNodeController extends Controller
{
	use ControllerTrait;

	/*模板文件夹*/
    protected $folder = 'back.system.workflow.node';
    protected $routePrefix = 'admin.workflow.node';
    protected $routeHighLightPrefix = 'admin.workflow';
    protected $service;

    public function __construct(Service $service)
    {
    	$this->service = $service;
    }

    public function setStoreReturnRoute()
    {
    	$workflowId = getWorkflowId('', true);
    	$this->storeReturn = route('admin.workflow.setting', $workflowId);
    }

    public function setUpdateReturnRoute()
    {
    	$workflowId = getWorkflowId('', true);
    	$this->updateReturn = route('admin.workflow.setting', $workflowId);
    }
}
