<?php
/**
 * Created by PhpStorm.
 * User: xinxin.lv
 * Date: 2018/1/23
 * Time: 下午3:52
 */

namespace App\Http\Controllers\Back\System;

use App\Http\Controllers\Controller;
use App\Traits\ControllerTrait;
use App\Services\CategoryService as Service;

/**
 * Class RegulationsController.
 *
 * @package namespace App\Http\Controllers;
 */
class CategoryController extends Controller
{
    use ControllerTrait;

    /*模板文件夹*/
    protected $folder = 'back.system.category';
    protected $routePrefix = 'admin.cate';

    protected $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        if (request()->ajax()) {
            return $this->service->datatables();
        } else {
            $results = $this->service->index();

            return view(getThemeTemplate($this->folder . '.index'))->with($results);
        }
    }
}