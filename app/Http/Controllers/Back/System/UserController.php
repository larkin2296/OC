<?php

namespace App\Http\Controllers\Back\System;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ControllerTrait;
use App\Traits\EncryptTrait;
use App\Services\UserService as Service;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    use ControllerTrait;

	use EncryptTrait;

	/*模板文件夹*/
    protected $folder = 'back.system.user';

    protected $routePrefix = 'admin.user';

    protected $encryptConnection = 'user';

    protected $service;

    public function __construct(Service $service)
    {
    	$this->service = $service;

        $this->setEncryptConnection($this->encryptConnection);
    }
    /**
     * 用户列表
     * @return [type] [description]
     */
    public function index()
    {
<<<<<<< HEAD
        dd(1230);
=======
>>>>>>> daab3c90c5bd55c22d3d2437ec68cbb8ec77370e
    	if( request()->ajax() ) {
    		return $this->service->datatables();
    	} else {
    		$results = $this->service->index();

	        return view(getThemeTemplate($this->folder . '.index'))->with($results);
    	}
    }
    /**
     * 重置密码
     * @return [type] [description]
     */
    public function resetPass($id)
    {
        $results = $this->service->resetPass($id);

        return response()->json($results);
    }
    /**
     * 锁定用户
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function lock($id)
    {
        $results = $this->service->lock($id);

        return response()->json($results);
    }

    /**
     * 解锁用户
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function unlock($id)
    {
        $results = $this->service->unlock($id);

        return response()->json($results);
    }

    private function storeRules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('users')->where(function($query) {
                    return $query->whereNull('deleted_at');
                }),
            ],
            'truename' => 'required',
            'password' => 'required',
            'role' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'company' => 'required',
            'is_check_email' => 'required',
        ];
    }

    private function updateRules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('users')->where(function($query) {
                    return $query->whereNull('deleted_at');
                })->ignore($this->decodeId(getRouteParam('user')), 'id'),
            ],
            'truename' => 'required',
            'role' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'company' => 'required',
            'is_check_email' => 'required',
        ];
    }

    private function messages()
    {
        return [
            'name.required' => '账号不能为空',
            'name.unique' => '账号已经存在',
            'truename.required' => '真实姓名不能为空',
            'password.required' => '密码不能为空',
            'role.required' => '角色不能为空',
            'mobile.required' => '手机号不能为空',
            'email.required' => '邮箱不能为空',
            'company.required' => '公司不能为空',
            'is_check_email.required' => '是否验证邮箱不能为空',
        ];
    }
}
