<?php 

return [
	'structure' => [
		'system' => [
			'next' => [
				'user' => [
					'route' => 'admin.user.index',
					'icon' => 'fa fa-user',
					'permission' => 'manage-user',
					'route_prefix' => 'admin.user',
				],
				'role' => [
					'route' => 'admin.role.index',
					'icon' => 'fa fa-user',
					'permission' => 'manage-role',
					'route_prefix' => 'admin.role',
				],
				'permission' => [
					'route' => 'admin.permission.index',
					'icon' => 'fa fa-user',
					'permission' => 'manage-permission',
					'route_prefix' => 'admin.permission',
				],
				'menu' => [
					'route' => 'admin.menu.index',
					'icon' => 'fa fa-user',
					'permission' => 'manage-menu',
					'route_prefix' => 'admin.menu',
				],
				'workflow' => [
					'route' => 'admin.workflow.index',
					'icon' => 'fa fa-user',
					'permission' => 'manage-workflow',
					'route_prefix' => 'admin.workflow',	
				],
				/*字典管理*/
				'dictionaries' => [
					'route' => 'admin.dictionaries.index',
					'icon' => 'fa fa-user',
					'permission' => 'manage-workflow',
					'route_prefix' => 'admin.dictionaries',	
				],
				/*报告规则*/
				'rule' => [
					'route' => 'admin.rule.index',
					'icon' => 'fa fa-user',
					'permission' => 'manage-workflow',
					'route_prefix' => '',	
				],
			],
			'icon' => 'fa fa-user',
			'permission' => 'manage-system',
			'route_prefix' => '',
		],
        'base' => [
            'next' => [
                'after' => [
                    'route' => 'admin.drug.index1',
                    'icon' => 'fa fa-user',
                    'permission' => 'manage-user',
                    'route_prefix' => 'admin.user',
                ],
                'before' => [
                    'route' => 'admin.drug.index',
                    'icon' => 'fa fa-user',
                    'permission' => 'manage-role',
                    'route_prefix' => 'admin.role',
                ],
            ],
            'icon' => 'fa fa-user',
            'permission' => 'manage-system',
            'route_prefix' => '',
        ],

        /*系统首页*/
        'index' => [
			'next' => [
				/*报告任务*/
				'report-task' => [
					'route' => 'admin.report.task.index',
					'icon' => 'fa fa-user',
					'permission' => 'manage-user',
					'route_prefix' => 'admin.report.task',
				],

				'question-task' => [
					'route' => 'admin.questioning.index',
					'icon' => 'fa fa-user',
					'permission' => 'manage-user',
					'route_prefix' => '',
				],
			],
			'icon' => 'fa fa-user',
			'permission' => 'manage-system',
			'route_prefix' => '',
		],

		'quality' => [
			'next' => [
				'question' => [
					'route' => 'admin.question.index',
					'icon' => 'fa fa-user',
					'permission' => 'manage-user',
					'route_prefix' => 'admin.question',
				],
				'datatrace' => [
					'route' => 'admin.datatrace.index',
					'icon' => 'fa fa-user',
					'permission' => 'manage-user',
					'route_prefix' => 'admin.datatrace',
				],
			],
			'icon' => 'fa fa-user',
			'permission' => 'manage-system',
			'route_prefix' => '',
		],
	],

	'maps' => [
		'system' => '系统管理',
		'user' => "用户管理",
		'role' => '角色管理',
		'permission' => '权限管理',
		'menu' => '菜单管理',
		'workflow' => '工作流管理',
		'base' => '基础信息',
		'after' => '药品信息-上市后',
		'before' => '药品信息-上市前',
		'index' => "系统首页",
		'report-task' => "报告任务",
		'dictionaries' => '字典管理',
		'question-task' => '质疑任务',
		'rule' => '报告规则',
		'quality' => '质量管理',
		'question' => "质疑管理",
		'datatrace' => "稽查管理",
	],
];