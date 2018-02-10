<?php 

return [
	'name' => [
		'label' => '账号',
		'name' => 'name',
		'placeholder' => '请输入账号',
		'rules' => [
		    'required' => '账号不能为空',
		]
	],
	'truename' => [
		'label' => '真实姓名',
		'name' => 'truename',
		'placeholder' => '请输入真实姓名',
		'rules' => [
		    'required' => '真实姓名不能为空',
		]
	],
	'mobile' => [
		'label' => '手机号',
		'name' => 'mobile',
		'placeholder' => '请输入手机号',
		'rules' => [
		    'required' => '手机号不能为空',
		]
	],
	'company' => [
		'label' => '公司',
		'name' => 'company',
		'placeholder' => '请输入公司',
		'rules' => [
		    'required' => '公司不能为空',
		]
	],
	'is_check_email' => [
		'label' => '是否验证邮箱',
		'name' => 'is_check_email',
		'placeholder' => '是否验证邮箱',
		'rules' => [
		    'required' => '是否验证邮箱不能为空',
		]
	],
	'notes' => [
		'label' => '备注',
		'name' => 'notes',
		'placeholder' => '请输入备注',
	],
	'email' => [
	    'label' => '邮箱',
	    'placeholder' => '请输入邮箱',
	    'rules' => [
	        'required' => '邮箱不能为空',
	        'email' => '邮箱格式不正确',
	        'unique' => '邮箱已存在',
	    ],
	],
	'password' => [
		'label' => '密码',
		'name' => 'password',
		'placeholder' => '请输入密码',
		'rules' => [
		    'required' => '密码不能为空',
		    'minlength' => '密码不能小于{0}位',
		]
	],
	'password_confirmation' => [
	    'label' => '确认密码',
	    'placeholder' => '请输入确认密码',
	    'rules' => [
	        'required' => '确认密码不能为空',
	        'minlength' => '确认密码不能小于{0}位',
	        'equalto' => '确认密码和密码不一致'
	    ],
	],

	'role' => [
		'label' => '角色',
		'placeholder' => '选择角色'
	],
];