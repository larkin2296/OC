<?php 

return [
	/**
	 * 可选为 metronic
	 */
	'theme' => [
		/**
		 * 主题文件夹
		 */
		'folder' => 'themes',
		/**
		 * 主题名称
		 */
		'name' => 'metronic',
	],

	/**
	 * redis 配置
	 */
	'redis' => [
		/**
		 * 前缀
		 */
		'prefix' => 'back:',
	],

	/**
	 * cache 配置
	 */
	'cache' => [
		/**
		 * 前缀
		 */
		'prefix' => 'back_'
	],

	/*开关配置*/
	'switch' => [
		/*注册开关是否开启*/
		'register' => true,
	],

	/*性别*/
	'sex' => [
		'value' => [
			'1' => '男',
			'2' => '女',
			'3' => '其他'
		],
		'map' => [
			'male' => '1',
			'female' => '2',
			'other' => '3',
		]
	],

	/* 通用验证是否 */
	'commoncheck' => [
		'value' => [
			'1' => '是',
			'2' => "否"
		],
		'map' => [
			'true' => 1,
			'false' => 2,
		]
	],

	/* 用于用户权限，文字对应 */
	'module' => [
		'value' => [
			'user' => '用户',
			'role' => '角色',
			'permission' => '权限',
			'menu' => '菜单',
		],
	],

	/* 项目角色对应组织架构 */
	'role_organize' => [
		'value' => [
			'1' => "资料管理员",
			'2' => "数据录入员",
			'3' => "数据质控QC",
			'4' => "医学审评",
			'5' => "医学审评QC",
			'6' => "报告递交",
			'7' => '企业管理员',
		],
		'map' => [
			'source_manager' => 1,
			'data_insert' => 2,
			'data_qc' => 3,
			'medical_exam' => 4,
			'medical_exam_qc' => 5,
			'report_submit' => 6,
			'company_manager' => 7,
		],
	],

	'report' => [
		'tab' => [
			'value' => [
				'1' => "概览",
				'2' => "基本信息",
				'3' => "患者信息",
				'4' => "药物信息",
				'5' => "不良事件",
				'6' => "报告评价",
				'7' => "事件描述",
				'8' => "问卷",
				'9' => "附件信息",
			],

			'map' => [
				'overview' => 1,
				'basic' => 2,
				'patient' => 3,
				'drug' => 4,
				'event' => 5,
				'appraise' => 6,
				'describe' => 7,
				'question' => 8,
				'attachment' => 9,
			],
		],
	],

	/*菜单位置*/
	'menu_position' => [
		'value' => [
			'1' => '通用',
			'2' => '后台',
			'3' => '公司',
		],
		'map' => [
			'all' => 1,
			'admin' => 2,
			'company' => 3,
		],
	],
];