<?php
namespace App\Http\Controllers\Back\Homepage;
//use App\Events\Questioning\questioning;
use Illuminate\Http\Request;
use App\Traits\EncryptTrait;
use App\Http\Controllers\Controller;
use App\Traits\ControllerTrait;
use App\Services\QuestioningService as Service;
class QuestioningController extends Controller
{
    use ControllerTrait;

    use EncryptTrait;
    /*模板文件夹*/
    protected $folder = 'back.homepage.questioning';
    /*路由*/
    protected $routePrefix = 'admin.questioning';

    protected $encryptConnection = 'questioning';

    protected $service;

    public function __construct(Service $service)
    {
        $this->service = $service;

        $this->setEncryptConnection($this->encryptConnection);
    }
    /*展示页面*/
    public function index()
    {
        if( request()->ajax() ) {
            return $this->service->datatables();
        } else {
            $results = $this->service->index();
            return view(getThemeTemplate($this->folder  . '.index'))->with($results);
        }
    }
    /*发送页面*/
    public function open($id)
    {
        $results = $this->service->show($id);
        return view(getThemeTemplate($this->folder . '.send'))->with($results);
    }
    /*发送质疑*/
    public function create(){
        //模拟数据
        $results = $this->service->create();
        return response()->json($results);
    }
    /*关闭质疑*/
    public function close($id)
    {
        $results = $this->service->end($id);
        return response()->json($results);
    }
    /*查看跳转到Tab*/
    public function tabs($id)
    {
        return 'Tab页面'.$id;
    }
}
