<?php

namespace App\Http\Controllers\Back\System;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ControllerTrait;
use App\Services\MenuService as Service;
use Illuminate\Validation\Rule;

class MenuController extends Controller
{
    use ControllerTrait;

	/*模板文件夹*/
    protected $folder = 'back.system.menu';
    protected $routePrefix = 'admin.menu';

	protected $service;
	public function __construct(Service $service)
	{
		$this->service = $service;
	}

	/**
	 * 排序
	 * @return [type] [description]
	 */
	public function sort()
	{
		$results = $this->service->sort();

		return response()->json($results);
	}

}
