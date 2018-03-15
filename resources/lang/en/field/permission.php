<?php 

return [
	'name' => [
		'label' => '权限名称',
		'name' => 'name',
		'placeholder' => '权限名称',
		'rules' => [
		    'required' => '权限名称不能为空',
		]
	],
	'display_name' => [
		'label' => '权限显示名称',
		'name' => 'display_name',
		'placeholder' => '权限显示名称',
		'rules' => [
		    'required' => '权限显示名称不能为空',
		]
	],
	'description' => [
		'label' => '权限描述',
		'name' => 'description',
		'placeholder' => '权限描述',
		'rules' => [
		    'required' => '权限描述不能为空',
		]
	]
];