<?php 
/**
 * 验证角色是否有组织结构
 */
if ( !function_exists('checkRoleHasOrganizeRoleId') ) {
	function checkRoleHasOrganizeRoleId($roles, $organizeRoleId)
	{
		$allowedOrganizeRoleIds = $roles->keyBy('organize_role_id')->keys()->toArray();

		return in_array($organizeRoleId, $allowedOrganizeRoleIds);
	}
}

/**
 * 企业管理员
 */
if ( !function_exists('isCompanyManager') ) {
	function isCompanyManager($roles)
	{
		$organizeRoleId = getRoleOrganizeValue('company_manager');

		return checkRoleHasOrganizeRoleId($roles, $organizeRoleId);
	}
}

/**
 * 企业资料管理员
 */
if ( !function_exists('isSourceManager') ) {
	function isSourceManager($roles)
	{
		$organizeRoleId = getRoleOrganizeValue('source_manager');

		return checkRoleHasOrganizeRoleId($roles, $organizeRoleId);
	}
}

/**
 * 企业数据录入员
 */
if ( !function_exists('isDataInsert') ) {
	function isDataInsert($roles)
	{
		$organizeRoleId = getRoleOrganizeValue('data_insert');

		return checkRoleHasOrganizeRoleId($roles, $organizeRoleId);
	}
}

/**
 * 企业数据质控QC
 */
if ( !function_exists('isDataQc') ) {
	function isDataQc($roles)
	{
		$organizeRoleId = getRoleOrganizeValue('data_qc');

		return checkRoleHasOrganizeRoleId($roles, $organizeRoleId);
	}
}

/**
 * 企业医学审评
 */
if ( !function_exists('isMedicalExam') ) {
	function isMedicalExam($roles)
	{
		$organizeRoleId = getRoleOrganizeValue('medical_exam');

		return checkRoleHasOrganizeRoleId($roles, $organizeRoleId);
	}
}

/**
 * 企业医学审评QC
 */
if ( !function_exists('isCompanyManagerQc') ) {
	function isCompanyManagerQc($roles)
	{
		$organizeRoleId = getRoleOrganizeValue('medical_exam_qc');

		return checkRoleHasOrganizeRoleId($roles, $organizeRoleId);
	}
}

/**
 * 企业报告递交
 */
if ( !function_exists('isReportSubmit') ) {
	function isReportSubmit($roles)
	{
		$organizeRoleId = getRoleOrganizeValue('report_submit');

		return checkRoleHasOrganizeRoleId($roles, $organizeRoleId);
	}
}