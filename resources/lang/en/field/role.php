<?php 

return [
	'name' => [
		'label' => '角色名称',
		'name' => 'name',
		'placeholder' => '请输入角色名称',
		'rules' => [
		    'required' => '角色名称不能为空',
		]
	],
	'display_name' => [
		'label' => '角色显示名称',
		'name' => 'display_name',
		'placeholder' => '请输入角色显示名称',
		'rules' => [
		    'required' => '角色显示名称不能为空',
		]
	],
	'description' => [
		'label' => '角色描述',
		'name' => 'description',
		'placeholder' => '请输入角色描述',
		'rules' => [
		    'required' => '角色描述不能为空',
		]
	]
];