<?php 

return [
	'name' => [
		'label' => '名称',
		'name' => 'name',
		'placeholder' => '请输入名称',
		'rules' => [
		    'required' => '名称不能为空',
		]
	],
	'status' => [
		'label' => '是否有效',
		'name' => 'status',
		'placeholder' => '请输入是否有效',
		'rules' => [
		    'required' => '是否有效不能为空',
		]
	],
	'is_use' => [
		'label' => '是否默认',
		'name' => 'is_use',
		'placeholder' => '请输入是否默认',
		'rules' => [
		    'required' => '是否默认不能为空',
		]
	],
];