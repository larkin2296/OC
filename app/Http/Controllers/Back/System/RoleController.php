<?php

namespace App\Http\Controllers\Back\System;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ControllerTrait;
use App\Services\RoleService as Service;
use Illuminate\Validation\Rule;
use App\Traits\EncryptTrait;

class RoleController extends Controller
{
    use ControllerTrait;
	use EncryptTrait;

	/*模板文件夹*/
    protected $folder = 'back.system.role';
    protected $routePrefix = 'admin.role';
    protected $encryptConnection = 'role';

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
     * 角色用户--拥有此角色的用户列表
     * @return [type] [description]
     */
    //TODO: 这里需要返回的是 datatables 表头包含：序号，登陆账号，真实姓名
    public function userShow($id)
    {
        $results = $this->service->userShow($id);

        dd($results);

        return view(getThemeTemplate($this->folder . '.user'))->with($results);
    }

    /**
     * 修改角色权限
     * @param  [type] $id [角色id]
     * @return [type]     [description]
     */
    public function permissionEdit($id)
    {
        $results = $this->service->permissionEdit($id);
        return view(getThemeTemplate($this->folder . '.permission'))->with($results);
    }

    /**
     * 角色权限保存
     * @param  [type] $id [角色id]
     * @return [type]     [description]
     */
    //TODO:这里是返回页面
    public function permissionUpdate($id)
    {
        $results = $this->service->permissionUpdate($id);

        if($results['result']) {
            return redirect()->route($this->routePrefix . '.index');
        } else {
            return redirect()->back()->withErrors($results['message']);
        }
    }

    /**
     * 组织结构的角色列表
     * @return [type] [description]
     */
    public function organize($organizeRoleId)
    {
        $results = $this->service->organize($organizeRoleId);

        return response()->json($results);
    }

    private function storeRules()
    {
    	return [
    		'name' => [
    			'required',
    			Rule::unique('roles'),
    		],
    		'display_name' => 'required',
    		'description' => 'required',
    	];
    }

    private function updateRules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('roles')->ignore($this->decodeId(getRouteParam('role')), 'id'),
            ],
            'display_name' => 'required',
            'description' => 'required',
        ];
    }

    private function messages()
    {
        return [
            'name.required' => '角色名称不能为空',
            'name.unique' => '角色名称已经存在',
            'display_name.required' => '角色显示名称不能为空',
            'description.required' => '角色描述不能为空',
        ];
    }
}
