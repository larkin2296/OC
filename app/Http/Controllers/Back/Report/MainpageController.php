<?php
namespace App\Http\Controllers\Back\Report;
use App\Traits\DictionariesTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ControllerTrait;
use App\Traits\EncryptTrait;
use App\Traits\ModelTrait;
use App\Services\Report\MainpageService as Service;
use Illuminate\Validation\Rule;

class MainpageController extends Controller
{
    use ControllerTrait;

    use EncryptTrait;

    use DictionariesTrait;
    /*模板文件夹*/
    protected $folder = 'back.report.mainpage';

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
    public function index($source_id = '')
    {
        if(request()->ajax()) {
            return $this->service->datatables($source_id);
        } else {
            $results = $this->service->index();
            return view(getThemeTemplate($this->folder  . '.index'))->with($results);
        }

    }
    /*新建查询*/
    public function create()
    {
        $results = $this->service->create();
        return response()->json($results);
    }
    /*复制查询*/
    public function copy($id)
    {
        $results = $this->service->copyData($id);
        return response()->json($results);
    }
    /*删除 修改状态*/
    public function edit($id)
    {
        $results = $this->service->edit($id);
        return response()->json($results);
    }
    /*查询*/
    public function show($id)
    {
        return '';
    }
    /*新建版本*/
    public function newreport($id)
    {
        $results = $this->service->newReport($id);
        return response()->json($results);
    }

}