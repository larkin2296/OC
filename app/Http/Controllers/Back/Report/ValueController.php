<?php

namespace App\Http\Controllers\Back\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ControllerTrait;
use App\Traits\EncryptTrait;
use App\Services\Report\ValueService as Service;
use Illuminate\Validation\Rule;

class ValueController extends Controller
{
    use ControllerTrait;

	use EncryptTrait;

	/*模板文件夹*/
    protected $folder = 'back.report.value';

    protected $routePrefix = 'admin.report';

    protected $encryptConnection = 'report';

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
    public function index($reportId)
    {
        $results = $this->service->index($reportId);

        return view(getThemeTemplate($this->folder . '.index'))->with($results);
    }

    /**
     * 获取 报告的tab数据
     * @param  [type] $reportId    [description]
     * @param  [type] $reportTabId [description]
     * @return [type]              [description]
     */
    public function reportTabHtml($reportId, $reportTabId)
    {
        $results = $this->service->reportTabHtml($reportId, $reportTabId);

        return view(getThemeTemplate($this->folder . '.components.' . $results['reportTabId']))->with($results);
    }

    /**
     * 报告数据保存
     * @return [type] [description]
     */
    public function save($reportId, $reportTabId)
    {
        $results = $this->service->save($reportId, $reportTabId);

        return response()->json($results);
    }
    
}
