<?php
namespace App\Http\Controllers\Back\Home\Management;
//use App\Events\Questioning\questioning;
use Illuminate\Http\Request;
use App\Traits\EncryptTrait;
use App\Http\Controllers\Controller;
use App\Traits\ControllerTrait;
use App\Services\PurchaseService as Service;
Class PurchaseController extends Controller{
    use ControllerTrait;

    use EncryptTrait;
    /*模板文件夹*/
    protected $folder = 'back.management.card';
    /*路由*/
    protected $routePrefix = 'admin.management';

    protected $encryptConnection = 'management';

    protected $service;

    public function __construct(Service $service)
    {
        $this->service = $service;

        $this->setEncryptConnection($this->encryptConnection);
    }
}