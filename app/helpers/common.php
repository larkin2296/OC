<?php 

if ( !function_exists('getRouteParam') ) {
	function getRouteParam($key)
	{
		return request()->route($key) ?: '';
	}
}

/**
 * 获取当前登录用户
 */
if ( !function_exists('getUser') ) {
	function getUser()
	{
		return auth()->user();
	}
}

/**
 * 获取当前登录用户id
 */
if ( !function_exists('getUserId') ) {
	function getUserId()
	{
		$user = getUser();

		return $user->id;
	}
}

/**
 * 获取单位id
 */
if ( !function_exists('getCompanyId') ) {
	function getCompanyId($companyId = 0)
	{
	    #TODO: sidlee modify by 2018-01-22
		return $companyId ?: session('company_id',0);
	}
}

/**
 * 获取工作流id
 */
if ( !function_exists('getWorkflowId') ) {
	function getWorkflowId($workflowId = '', $encrypt = false)
	{
		$workflowId = $workflowId ?: session('workflow_id');
		if (!$encrypt) {
			return $workflowId;
		} else {
			return app(\App\Repositories\Interfaces\WorkflowRepository::class)->encodeId($workflowId);
		}
	}
}

/**
 * 是否显示菜单
 */
if ( !function_exists('checkMenuPosition') ) {
	function checkMenuPosition($position)
	{
		$menuPositions = getCompanyId() ? [getMenuPositionValue('all'), getMenuPositionValue('company')] : [getMenuPositionValue('all'), getMenuPositionValue('admin')];

		return in_array($position, $menuPositions);
		
	}
}

/**
 * 计算倒计时
 */
if ( !function_exists('calcCarbonCountdown') ) {
	function calcCarbonCountdown($value)
	{	
		$value = new \Carbon\Carbon($value);

		/*当前时间*/
		$now = new \Carbon\Carbon();

		$string = '';

		$isOverdue = $value >= $now ? true : false;

		if(!$diffDays = $value->diffInDays($now, true)) {
			if( !$diffHours = $value->diffInHours($now, true) ) {
				if( !$diffMinutes = $value->diffInMinutes($now, true) ) {
					$string = $isOverdue ? '0m' : '-1m';
				}else {
					$string = $isOverdue ? $diffMinutes : -$diffMinutes;
					$string .= 'm';
				}
			} else {
				$string = $isOverdue ? $diffHours : -$diffHours;
				$string .= 'h';
			}
		} else {
			$string = $isOverdue ? $diffDays : -$diffDays;
			$string .= 'd';
		}

		return $string;
	}
}

/**
 * 计算文件大小
 */
if ( !function_exists('calcFileSize') ) {
	function calcFileSize($value, $unit = 'MB')
	{	
		switch( $unit ) {
			case 'MB' :
				$value = number_format($value / 1024 /1024, 2);
				break;
			case 'KB' :
				$value = number_format($value / 1024, 2);
				break;
		}

		return $value . $unit;
	}
}
