<?php
/**
 * 报告任务新建版本
 */
namespace App\Http\Controllers\Back\Report\Task;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Report\Task\NewVersionService as Service;
use App\Traits\ControllerTrait;

class NewVersionController extends Controller
{
	use ControllerTrait;

	/*模板文件夹*/
    protected $folder = 'back.report.task.newversion';

    protected $routePrefix = 'admin.report.task.newversion';

    public function __construct(Service $service)
    {
    	$this->service = $service;
    }

    /**
	 * 报告任务-创建新版本
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
    public function index($id)
    {
    	$results = $this->service->index($id);
           
    	return view(getThemeTemplate($this->folder . '.index'))->with($results);
    }

    /**
     * 报告任务-保存新版本
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function store($id)
    {
    	$results = $this->service->store($id);

    	return response()->json($results);
    }
}
