<?php 

return [
	'name' => [
		'label' => '流程名称',
		'name' => 'name',
		'placeholder' => '请输入流程名称',
		'rules' => [
		    'required' => '流程名称不能为空',
		]
	],
	'en_name' => [
		'label' => '流程名称(英文)',
		'name' => 'en_name',
		'placeholder' => '请输入流程名称(英文)',
		'rules' => [
		    'required' => '流程名称(英文)不能为空',
		]
	],
	'is_message_notice' => [
		'label' => '是否启用短信通知',
		'name' => 'is_message_notice',
	],
	'is_email_notice' => [
		'label' => '是否启用Email通知',
		'name' => 'is_email_notice',
	],
	'organize_role_id' => [
		'label' => '组织结构角色',
		'name' => 'organize_role_id',
		'rules' => [
		    'required' => '组织结构角色不能为空',
		]
	],
	'role_id' => [
		'label' => '角色',
		'name' => 'role_id',
		'rules' => [
		    'required' => '角色不能为空',
		]
	],
	'rule' => [
		'label' => '规则',
		'name' => 'rule',
		'placeholder' => '请输入规则',
	],
	'description' => [
		'label' => '描述',
		'name' => 'description',
		'placeholder' => '请输入描述',
	],
];