<?php 

return [
	'name' => [
		'label' => '菜单名称',
		'name' => 'name',
		'placeholder' => '请输入菜单名称',
		'rules' => [
		    'required' => '菜单名称不能为空',
		]
	],
	'route' => [
		'label' => '菜单路由',
		'name' => 'route',
		'placeholder' => '请输入菜单路由',
		'rules' => [
		    'required' => '菜单路由不能为空',
		]
	],
	'icon' => [
		'label' => '菜单图标',
		'name' => 'icon',
		'placeholder' => '请输入菜单图标',
		'rules' => [
		    'required' => '菜单图标不能为空',
		]
	],

	'permission' => [
		'label' => '菜单权限',
		'name' => 'permission',
		'placeholder' => '请输入菜单权限',
		'rules' => [
		    'required' => '菜单权限不能为空',
		]
	],

	'description' => [
		'label' => '菜单描述',
		'name' => 'description',
		'placeholder' => '请输入菜单描述',
		'rules' => [
		    'required' => '菜单描述不能为空',
		]
	]
];