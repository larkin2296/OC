<?php 

/**
 * 冗余数据
 */
return [
	/*报告冗余字段*/
	'report' => [
		/*|||   first 代表第一条数据， normal 按照正常格式    ||||*/
		/*基本信息*/
		'basic' => [
			//pv获悉时间
			'report_drug_safety_date' => 'normal',
			// 事件发生国家
			'ae_country' => 'normal',
			// 企业报告类型
			'received_from_id' => 'normal', 
			// 项目编号
			'research_id' => 'normal',
			// 中心编号
			'center_number' => 'normal',
			// 迟到原因
			'delayed_reason' => 'normal',

			/*报告者信息中--判断是否是首要报告*/
			// 报告者姓名
			'reporter_name' => 'table_first',
			// 单位名称
			'reporter_organisation' => 'table_first',
			// 部门
			'reporter_department' => 'table_first',
			// 国家
			'reporter_country' => 'table_first',
			// 省
			'reporter_staeor_province' => 'table_first',
			// 市
			'reporter_city' => 'table_first',
			// 邮编
			'reporter_post' => 'table_first',
			// 电话
			'reporter_telephone_number' => 'table_first',

			/*文献信息*/
			// 文献发表年
			'literature_published_year' => 'normal',
			// 文献作者
			'literature_author' => 'normal',
			// 期刊名
			'literature_published_journals' => 'normal',
			// 文献标题
			'literature_title' => 'normal',
		],
		/*药物*/
		'drug' => [
			// 商品名称
			'brand_name' => 'normal',
			// 首要商品名称
			'first_brand_name' => 'first',
			// 药品名称
			'drug_name' => 'normal',
			// 首要药品名称
			'first_drug_name' => 'first',
			// 通用名称
			'generic_name' => 'normal', 
			// 首要通用名称
			'first_generic_name' => 'first', 
		],

		/*不良事件*/
		'event' => [
			// 不良事件
			'event_term' => 'normal' ,
			// 首要不良事件
			'first_event_term' => 'first' ,
			// // 是否严重   --- 删除
			// 'seriousness' => 'first' ,
			/*不良事件发生时间*/
			'event_of_onset' => 'first' ,
		],

		/*患者信息*/
		'patient' => [
			// 姓名
			'patient_name' => 'normal',
			// 患者编号
			'subject_number' => 'normal',
			// 出生日期
			'date_of_birth' => 'normal',
			// 年龄
			'age' => 'normal',
			// 年龄单位
			'age_at_time_of_onset_unit' => 'normal',
			// 性别
			'sex' => 'normal',
			// 电话
			'patient_contact_infomation' => 'normal',
		],
	],

	/*报告任务冗余字段*/
	'report_task' => [
		'basic' => [
			// 企业报告类型
			'received_from_id' => 'normal',
		],
		'drug' => [
			// 药品名称
			'drug_name' => 'normal',
			// 首要药品名称
			'first_drug_name' => 'first',
		],

		'event' => [
			// 不良事件
			'event_term' => 'normal',
			// 首要不良事件
			'first_event_term' => 'first',
			/*首要不良事件是否是严重*/
			// 严重性
			'seriousness' => 'first',
			// 严重性标准
			'standard_of_seriousness' => 'first',
		],

		'appraise' => [
			// 因果关系
			'case_causality' => 'normal',
		],
	],

	/*报告详情冗余字段*/
	'report_value' => [
		'basic' => [
			/*事件发生国家*/
			'ae_country' => 'normal',
			/*企业报告类型*/
			'received_from_id' => 'normal',
			/*首次接受时间*/
			'report_first_received_date' => 'normal',

			/*报告者信息中--判断是否是首要报告*/
			// 报告者姓名
			'reporter_name' => 'table_first',
			// 单位名称
			'reporter_organisation' => 'table_first',
			// 部门
			'reporter_department' => 'table_first',
			// 国家
			'reporter_country' => 'table_first',
			// 报告者类型
			'reporter_type' => 'table_first',
			// 电话
			'reporter_telephone_number' => 'table_first',
			// 报告者职位
			'reporter_occupation' => 'table_first',
		],

		'drug' => [
			// 商品名称
			'brand_name' => 'first',
			// 怀疑用药
			'drug_type' => 'first',
			/*通用名称*/
			'generic_name' => 'first',
			/*生产厂家*/
			'manu_facture' => 'first',
		],

		'patient' => [
			// 姓名
			'patient_name' => 'normal',
			// 出生日期
			'date_of_birth' => 'normal',
			// 年龄
			'age' => 'normal',
			// 年龄单位
			'age_at_time_of_onset_unit' => 'normal',
			// 性别
			'sex' => 'normal',
			// 是否妊娠
			'pregnancy_report' => 'normal',
		],

		'event' => [
			/*不良事件名称*/
			'event_term' => 'first',
			/*不良事件发生事件*/
			'event_of_onset' => 'first' ,
			/*不良事件的结局*/
			'event_out_come' => 'first'
		],
	],
];