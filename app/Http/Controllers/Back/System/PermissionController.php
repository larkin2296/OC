<?php

namespace App\Http\Controllers\Back\System;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ControllerTrait;
use App\Services\PermissionService as Service;
use Illuminate\Validation\Rule;
use App\Traits\EncryptTrait;

class PermissionController extends Controller
{
    use ControllerTrait;
    use EncryptTrait;

	/*模板文件夹*/
    protected $folder = 'back.system.permission';
    protected $routePrefix = 'admin.permission';
    protected $encryptConnection = 'permission';

	protected $service;
	public function __construct(Service $service)
	{
		$this->service = $service;

        $this->setEncryptConnection($this->encryptConnection);
	}
	/**
	 * 角色列表
	 * @return [type] [description]
	 */
    public function index()
    {
    	if( request()->ajax() ) {
    		return $this->service->datatables();
    	} else {
    		$results = $this->service->index();

	        return view(getThemeTemplate($this->folder . '.index'))->with($results);
    	}
    }

    /**
     * 保存规则
     * @return [type] [description]
     */
    private function storeRules()
    {
    	return [
    		'name' => [
    			'required',
    			Rule::unique('permissions'),
    		],
    		'display_name' => 'required',
    		'description' => 'required',
    	];
    }

    /**
     * 修改规则
     * @return [type] [description]
     */
    private function updateRules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('permissions')->ignore($this->decodeId(getRouteParam('permission')), 'id'),
            ],
            'display_name' => 'required',
            'description' => 'required',
        ];
    }

    private function messages()
    {
        return [
            'name.required' => '权限名称不能为空',
            'name.unique' => '权限名称已经存在',
            'display_name.required' => '权限显示名称不能为空',
            'description.required' => '权限描述不能为空',
        ];
    }
}
