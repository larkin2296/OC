<?php 

/**
 * 获取redundance的配置
 */
if ( !function_exists('getRedundanceConfig') ) 
{
	function getRedundanceConfig($key) 
	{
		return config('back.redundance.' . $key);
	}
}

/**
 * 获取报告冗余字段
 */
if (!function_exists('getReportRedundanceField')) {
	function getReportRedundanceField($key = '')
	{
		$key = $key ? '.' . $key : '';
		return getRedundanceConfig('report' . $key);
	}
}

/**
 * 获取报告任务冗余字段
 */
if (!function_exists('getReportTaskRedundanceField')) {
	function getReportTaskRedundanceField($key = '')
	{
		$key = $key ? '.' . $key : '';
		return getRedundanceConfig('report_task' . $key);
	}
}

/**
 * 获取报告详情冗余字段
 */
if (!function_exists('getReportValueRedundanceField')) {
	function getReportValueRedundanceField($key = '')
	{
		$key = $key ? '.' . $key : '';
		return getRedundanceConfig('report_value' . $key);
	}
}