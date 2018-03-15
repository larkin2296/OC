<?php
namespace App\Http\Controllers\Back\Home\Management;
//use App\Events\Questioning\questioning;
use Illuminate\Http\Request;
use App\Traits\EncryptTrait;
use App\Http\Controllers\Controller;
use App\Traits\ControllerTrait;
use App\Services\ManagementService as Service;
class ManagementController extends Controller
{
    use ControllerTrait;

    use EncryptTrait;
    /*模板文件夹*/
    protected $folder = 'ocback.managements';
    /*路由*/
    protected $routePrefix = 'admin.management';
    /*加密id*/
    protected $encryptConnection = 'management';

    protected $service;

    public function __construct(Service $service)
    {
        $this->service = $service;

        $this->setEncryptConnection($this->encryptConnection);
    }
    /*油卡管理列表*/
    public function index()
    {
        if( request()->ajax() ) {
            return $this->service->datatables();
        } else {
            $results = $this->service->index();
            return view(getThemeTemplate($this->folder  . '.index'))->with($results);
        }
    }
    /*油卡添加*/
    public function create(){
        //模拟数据
        $results = $this->service->create();
        return response()->json($results);
    }
    /*油卡修改*/
    public function update($id)
    {
        $results = $this->service->update($id);
        return response()->json($results);
    }
    /*油卡删除*/
    public function delete($id)
    {
        $results = $this->service->destroy($id);
        return response()->json($results);
    }
    //修改页面
    public function store()
    {
        dd(121);
    }

    public function excel()
    {
        $results = $this->service->excel();
        return response()->json($results);
    }



}
