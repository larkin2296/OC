<?php

namespace App\Http\Controllers\Card\Supplier;
use App\Traits\ControllerTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\OcService\SupplierListService as Service;

class SupplierListController extends Controller
{
    use ControllerTrait;

    /*模板文件夹*/
    protected $folder = 'ocback.backstage.supplier';
    protected $routePrefix = 'admin.logistics';

    protected $service;
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * 订单列表
     * @return [type] [description]
     */
    public function index()
    {
        if( request()->ajax() ) {

            return $this->service->datatables();
        } else {
            $results = $this->service->index();

            return view(getThemeTemplate($this->folder . '.supplierlist'))->with($results);
        }
    }
    /**
     * 信息管理
     * @return [type] [description]
     */
    public function show()
    {
        $results = $this->service->showUserInfo();

        return response()->json($results);
    }
    /**
     * 信息修改
     * @return [type] [description]
     */
    public function store($id)
    {
        $results = $this->service->store($id);

        return response()->json($results);
    }
    /**
     * 卡密供货页面
     * @return [type] [description]
     */

    public function cardencry()
    {
        $results = $this->service->cardIndex();
        return view(getThemeTemplate($this->folder.'.suppliercamilo'))->with($results);
    }
    /**
     * 卡密添加
     * @return [type] [description]
     */

    public function create()
    {
        $results = $this->service->cardPassEncryption();
        return response()->json($results);
    }

}
