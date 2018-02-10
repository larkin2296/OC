<?php 

/**
 * 获取global的配置
 */
if ( !function_exists('getGlobalConfig') ) 
{
	function getGlobalConfig($key) 
	{
		return config('back.global.' . $key);
	}
}

/**
 * 获取主题文件
 */
if( !function_exists('getThemeFolder')) {
	function getThemeFolder()
	{
		return getGlobalConfig('theme.folder');
	}
}

/**
 * 获取主题名称
 */
if( !function_exists('getThemeName')) {
	function getThemeName()
	{
		return getGlobalConfig('theme.name');
	}
}

/**
 * 获取主题
 */
if (!function_exists('getTheme')) {
	function getTheme()
	{
		return getThemeFolder() . '.' . getThemeName();
	}
}

if (!function_exists('getThemeTemplate')) {
	function getThemeTemplate($template)
	{
		return getTheme() . '.' . $template;
	}
}

/**
 * 获取redis前缀
 */
if( !function_exists('getRedisPrefix')) {
	function getRedisPrefix($key = '')
	{
		return getGlobalConfig('redis.prefix') . $key;
	}
}

/**
 * 获取cache前缀
 */
if( !function_exists('getCachePrefix')) {
	function getCachePrefix($key = '')
	{
		return getGlobalConfig('cache.prefix') . $key;
	}
}

/**
 * 获取性别
 */
if( !function_exists('getSex') ) {
	function getSex()
	{
		return getGlobalConfig('sex.value');
	}
}

/**
 * 获取通用的true false
 */
if( !function_exists('getCommonCheck') ) {
	function getCommonCheck()
	{
		return getGlobalConfig('commoncheck.value');
	}
}

/**
 * 获取通用的验证的值
 */
if( !function_exists('getCommonCheckValue') ) {
	function getCommonCheckValue($bool = true)
	{	
		return $bool ? getGlobalConfig('commoncheck.map.true') : getGlobalConfig('commoncheck.map.false');
	}
}

/**
 * 获取通用验证显示的值
 */
if ( !function_exists('getCommonCheckShowValue') ) {
	function getCommonCheckShowValue($value, $trueVale='是', $falseValue='否')
	{
		if ( getCommonCheckValue(true) == $value) {
			return $trueVale;
		} else {
			return $falseValue;
		}
	}
}

/**
 * 获取组织结构的值
 */
if ( !function_exists('getRoleOrganize') ) 
{
	function getRoleOrganize() 
	{
		return getGlobalConfig('role_organize.value');
	}
}

if ( !function_exists('getRoleOrganizeMap') ) 
{
	function getRoleOrganizeMap() 
	{
		return getGlobalConfig('role_organize.map');
	}
}

if ( !function_exists('getRoleOrganizeValue') ) 
{
	function getRoleOrganizeValue($key) 
	{
		return getGlobalConfig('role_organize.map.' . $key);
	}
}


/**
 * 获取菜单位置
 */
if ( !function_exists('getMenuPosition') ) 
{
	function getMenuPosition() 
	{
		return getGlobalConfig('menu_position.value');
	}
}

if ( !function_exists('getMenuPositionValue') ) 
{
	function getMenuPositionValue($key) 
	{
		return getGlobalConfig('menu_position.map.' . $key);
	}
}

/**
 * 获取 报告详情 tab数据
 */
if ( !function_exists('getReportTab') ) 
{
	function getReportTab($type = 'value') 
	{
		return getGlobalConfig('report.tab.' . $type);
	}
}

if ( !function_exists('getReportTabValue') ) 
{
	function getReportTabValue($key) 
	{
		return getGlobalConfig('report.tab.map.' . $key);
	}
}

/**
 * 报告规则 - 严重性
 */
if(!function_exists('severity'))
{
    function severity()
    {
        return [];
    }
}

/**
 * 系统模块
 */
if(!function_exists('module'))
{
    function module()
    {
        return [];
    }
}

/**
 * 原始资料-添加-文件类型
 */
if(!function_exists('get_file_class'))
{
    function get_file_class()
    {
        return [];
    }
}
/*字典*/
if(!function_exists('getDictionaries'))
{
    function getDictionaries()
    {
        return [];
    }
}

/**
 * 原始资料-添加-文件来源
 */
if(!function_exists('get_file_source'))
{
    function get_file_source()
    {
        return [];
    }
}

/**
 * 原始资料-添加-文件来源
 */
if(!function_exists('get_severity'))
{
    function get_severity()
    {
        return [];
    }
}


