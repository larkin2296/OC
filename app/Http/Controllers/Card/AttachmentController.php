<?php
/**
 * 附件控制器
 * lt
 */
namespace App\Http\Controllers\Card;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ControllerTrait;
use App\Traits\EncryptTrait;
use App\Services\OcService\AttachmentService as Service;

class AttachmentController extends Controller
{
    use ControllerTrait;

    use EncryptTrait;

    protected $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * 上传附件
     * @return [type] [description]
     */
    public function upload()
    {
        $results = $this->service->upload();

        return response()->json($results);
    }

    /**
     * 查看附件
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function show($id)
    {
        $results = $this->service->show($id);

        return response()->file($results);
    }
}
