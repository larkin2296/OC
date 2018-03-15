<?php
namespace App\Http\Controllers\Back\Quality;
use App\Events\Question\question;
use Illuminate\Http\Request;
use App\Traits\EncryptTrait;
use App\Http\Controllers\Controller;
use App\Traits\ControllerTrait;
use App\Services\QuestionService as Service;
class QuestionController extends Controller
{
    use ControllerTrait;

    use EncryptTrait;
    /*模板文件夹*/
    protected $folder = 'back.quality.question';
    /*路由*/
    protected $routePrefix = 'admin.question';

    protected $encryptConnection = 'question';

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
//            dd(1);
            return $this->service->datatables();
        } else {
//            dd(2);
            return view(getThemeTemplate($this->folder  . '.index'));
        }
    }
    /*查看跳转到Tab*/
    public function show($id)
    {
        return 'Tab页面'.$id;
    }

}
