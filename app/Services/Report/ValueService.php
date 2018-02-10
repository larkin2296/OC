<?php 

namespace App\Services\Report;

use App\Services\Service;
use App\Traits\ResultTrait;
use App\Traits\ExceptionTrait;
use App\Traits\ServiceTrait;
use App\Traits\QueueTrait;
use Exception;
use DB;

class ValueService extends Service
{
	use ServiceTrait, ResultTrait, ExceptionTrait, QueueTrait;

	/*报告数据显示*/
	public function index($reportId)
	{
		try {

			$tabs = $this->reportTabRepo->all();
			
			return [
				'tabs' => $tabs,
				'reportId' => $reportId,
				'saveBtn' => $this->canSave($reportId),
			];
		} catch (Exception $e) {
			abort(404);
		}
	}

	/**
	 * 报告详情是否可以保存
	 * @return [type] [description]
	 */
	private function canSave($reportId)
	{
		/*获取报告数据*/
		$reportId = $this->reportMainpageRepo->decodeId($reportId);
		$report = $this->reportMainpageRepo->find($reportId);

		/*获取当前用户*/
		$user = getUser();
		$roles = $user->roles;

		/*报告状态*/
		$reportStatus = $report->role_organize_status;

		return checkRoleHasOrganizeRoleId($roles, $reportStatus) && $user->id == $report->user_id;
	}

	/**
	 * 获取数据html
	 * @return [type] [description]
	 */
	public function reportTabHtml($reportId, $reportTabId)
	{
		try {
			/*获取公司*/
			$companyId = getCompanyId();
			/*获取报告id*/
			$reportId = $this->reportMainpageRepo->decodeId($reportId);
			/*获取报告tab的id*/
			$reportTabId = $this->reportTabRepo->decodeId($reportTabId);

			$where = [
				'report_id' => $reportId,
				'report_tab_id' => $reportTabId,
				'company_id' => $companyId,
			];
			$datas = $this->reportValueRepo->findWhere($where);

			$datas = $this->dealData($datas);

			return [
				'reportTabId' => $reportTabId,
				'datas' => $datas,
			];
		} catch (Exception $e) {
			abort(404);
		}
	}

	/**
	 * 处理数据
	 * @return [type] [description]
	 */
	private function dealData($datas)
	{
		$results = [];
		if($datas->isNotEmpty()) {
			foreach($datas as $data) {
				if($colDatas = $this->dealColData($results, $data)) {
					$results = $colDatas;
					continue;
				}

				if($tableDatas = $this->dealTableData($results,$data)) {
					$results = $tableDatas;
					continue;
				}

				$results['basic'][$data->name] = $data->value;
			}
		}

		return $results;
	}

	/**
	 * 处理 tab 分类数据
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	private function dealColData($results, $data)
	{

		if($data->col) {
			if(!isset($results['col'][$data->col])) {
				$results['col'][$data->col]['col_name'] = $data->col_name;
			}
			
			if($result = $this->dealTableData($results['col'][$data->col], $data)) {
				$results['col'][$data->col]['tables'] = $result['tables'];
			} else {
				$results['col'][$data->col]['basic'][$data->name] = $data->value;
			}

			return $results;
		}

		return '';
	}

	private function dealTableData($results, $data)
	{
		if($data->is_table == getCommonCheckValue(true)) {

			$results['tables'][$data->table_alias][$data->table_row_id][$data->name] = $data->value;

			return $results;
		}

		return '';
	}

	/**
     * 报告数据保存
     * @return [type] [description]
     */
	public function save($reportId, $reportTabId)
	{
		try {
			$exception = DB::transaction(function() use ($reportId, $reportTabId){
				if( !$this->canSave($reportId) ) {
					throw new Exception(trans('code/report.value.save.nopermission'), 2);
				}
				/*获取公司*/
				$companyId = getCompanyId();
				/*获取报告id*/
				$reportId = $this->reportMainpageRepo->decodeId($reportId);
				/*获取报告tab的id*/
				$reportTabId = $this->reportTabRepo->decodeId($reportTabId);
				/*当前用户id*/
				$userId = getUserId();

				$valueWhere = [
					'company_id' => $companyId,
					'report_id' => $reportId,
					'report_tab_id' => $reportTabId
				];
				$oldValues = $this->reportValueRepo->findWhere($valueWhere);

				/*清除table数据*/
				event(new \App\Events\Report\Value\ClearTableData($companyId, $reportId, $reportTabId));

				/*tab的数据*/
				$results = json_decode(request('tab'), true);
				if($results && is_array($results)) {
					/*保存数据*/
					$this->saveData($results, $companyId, $reportId, $reportTabId);

					/*推送报告任务冗余数据*/
					$this->pushReportTaskRedundance($companyId, $reportId, $reportTabId, $results);
					/*推送报告主页面冗余数据*/
					$this->pushReportRedundance($companyId, $reportId, $reportTabId, $results);
					/*推送报告详情冗余数据*/
					$this->pushReportValueRedundance($companyId, $reportId, $reportTabId, $results);
				}

				$newValues = $this->reportValueRepo->findWhere($valueWhere);

				// dd($newValues->toArray(), $oldValues->toArray());
				$attributes = [
					'company_id' => $companyId,
					'report_tab_id' => $reportTabId
				];
				event(new \App\Events\DataTrace\ReportValueCreate($oldValues, $newValues, $attributes, $reportId, $userId));

				return array_merge($this->results, [
					'result' => true,
					'message' => trans('code/report.value.save.success'),
				]);
			});
		} catch (Exception $e) {
			$exception = array_merge($this->results, [
				'result' => false,
				'message' => $this->handler($e, trans('code/report.value.save.fail')),
			]);
		}
		return array_merge($this->results, $exception);
	}

	/**
	 * 推送报告任务冗余数据
	 * @param  [type] $companyId   [description]
	 * @param  [type] $reportId    [description]
	 * @param  [type] $reportTabId [description]
	 * @param  [type] $results     [description]
	 * @return [type]              [description]
	 */
	private function pushReportTaskRedundance($companyId, $reportId, $reportTabId, $results)
	{
		$reportTabMaps = getReportTab('map');
		$reportTabMapsByKey = array_flip($reportTabMaps);


		if( isset($reportTabMapsByKey[$reportTabId]) && $reportTabMapsByKey[$reportTabId]) {
			/*tab的标识*/
			$reportTabIdentify = $reportTabMapsByKey[$reportTabId];

			/*有需要推送的字段*/
			if( $fields = getReportTaskRedundanceField($reportTabIdentify) ) {
				$redundanceData = $this->pushRedundance($companyId, $reportId, $reportTabId, $results, $fields);

				/*推送报告任务冗余数据*/
				$this->runSetReportTaskRedundanceData($companyId, $reportId, $redundanceData);
			}

		}
	}

	/**
	 * 推送报告冗余数据
	 * @param  [type] $companyId   [description]
	 * @param  [type] $reportId    [description]
	 * @param  [type] $reportTabId [description]
	 * @param  [type] $results     [description]
	 * @return [type]              [description]
	 */
	private function pushReportRedundance($companyId, $reportId, $reportTabId, $results)
	{
		$reportTabMaps = getReportTab('map');
		$reportTabMapsByKey = array_flip($reportTabMaps);


		if( isset($reportTabMapsByKey[$reportTabId]) && $reportTabMapsByKey[$reportTabId]) {
			/*tab的标识*/
			$reportTabIdentify = $reportTabMapsByKey[$reportTabId];

			/*有需要推送的字段*/
			if( $fields = getReportRedundanceField($reportTabIdentify) ) {
				$redundanceData = $this->pushRedundance($companyId, $reportId, $reportTabId, $results, $fields);

				/*推送报告主页面冗余数据*/
				$this->runSetReportRedundanceData($companyId, $reportId, $redundanceData);			
			}
		}
	}

	/**
	 * 推送报告详情冗余数据
	 * @param  [type] $companyId   [description]
	 * @param  [type] $reportId    [description]
	 * @param  [type] $reportTabId [description]
	 * @param  [type] $results     [description]
	 * @return [type]              [description]
	 */
	private function pushReportValueRedundance($companyId, $reportId, $reportTabId, $results)
	{
		$reportTabMaps = getReportTab('map');
		$reportTabMapsByKey = array_flip($reportTabMaps);


		if( isset($reportTabMapsByKey[$reportTabId]) && $reportTabMapsByKey[$reportTabId]) {
			/*tab的标识*/
			$reportTabIdentify = $reportTabMapsByKey[$reportTabId];

			/*有需要推送的字段*/
			if( $fields = getReportValueRedundanceField($reportTabIdentify) ) {
				$redundanceData = $this->pushRedundance($companyId, $reportId, $reportTabId, $results, $fields);

				/*推送报告详情冗余数据*/			
				event(new \App\Events\Report\Value\SetRedundanceData($companyId, $reportId, $redundanceData));
			}
		}
	}


	/**
	 * 推送冗余数据
	 * @param  [type] $companyId   [description]
	 * @param  [type] $reportId    [description]
	 * @param  [type] $reportTabId [description]
	 * @param  [type] $results     [description]
	 * @return [type]              [description]
	 */
	private function pushRedundance($companyId, $reportId, $reportTabId, $results, $fields)
	{
		$reportTabMaps = getReportTab('map');
		$reportTabMapsByKey = array_flip($reportTabMaps);


		if( isset($reportTabMapsByKey[$reportTabId]) && $reportTabMapsByKey[$reportTabId]) {
			/*tab的标识*/
			$reportTabIdentify = $reportTabMapsByKey[$reportTabId];

			/*药物信息*/
			$drug = getReportTabValue('drug');
			/*不良*/
			$event = getReportTabValue('event');
			/*基础信息*/
			$basic = getReportTabValue('basic');

			/*冗余数据*/
			$redundanceData = array_fill_keys(array_keys($fields), []);

			/*判断*/
			switch($reportTabId) {
				case $basic : 
					/*获取首要数据*/
					$curResult = current($results);
					if( $datas = $curResult['data'] ) {
						if( $tables = $datas['tables'] ) {
							foreach($tables as $table) {
								if( $values = $table['values']) {
									foreach( $values as $value ) {
										if( isset($value['primary_reporter'])) {

											if( $value['primary_reporter'] == getCommonCheckValue(true) ) {
												/*处理首要冗余数据*/
												$redundanceData = $this->dealFirstRedundanceDataByArray($value, $fields, $redundanceData);
											}
										} else {
											break;
										}
									}
								}
							}
						}
					}

					break;
				case $drug : 
					/*获取首要数据*/
					$curResult = current($results);
					
					/*处理首要冗余数据*/
					$redundanceData = $this->dealFirstRedundanceData($curResult, $fields, $redundanceData);

					break;
				case $event :
					/*获取首要数据*/
					$curResult = current($results);
					foreach($results as $result) {
						if( $datas = $result['data'] ) {
							$basicData = array_except($datas, ['tables']);
							/*判断是否是首要报告*/
							if( isset($basicData['initial_report']) && $basicData['initial_report'] == getCommonCheckValue(true)) {
								$curResult = $result;
								break;
							}
						}
					}

					/*处理首要冗余数据*/
					$redundanceData = $this->dealFirstRedundanceData($curResult, $fields, $redundanceData);
					break;
				default :
					
					break;
			}

			/*处理报告任务冗余数据*/
			$redundanceData = $this->dealCommonRedundanceData($results, $fields, $redundanceData);
			
			/*最后拼接处理报告任务数据*/
			return array_map(function($arr){
				return implode(',', $arr);
			}, $redundanceData);
		}
	}
	
	/**
	 * 处理冗余数据的首要数据
	 * @param  [type] $result         [description]
	 * @param  [type] $fields         [description]
	 * @param  [type] $redundanceData [description]
	 * @return [type]                 [description]
	 */
	private function dealFirstRedundanceData($result, $fields, $redundanceData)
	{
		if( $datas = $result['data'] ) {
			$basicData = array_except($datas, ['tables']);
			// dd($basicData, $fields, $redundanceData);
			$redundanceData = $this->dealFirstRedundanceDataByArray($basicData, $fields, $redundanceData);
		}

		return $redundanceData;
	}

	private function dealFirstRedundanceDataByArray($basicData, $fields, $redundanceData)
	{
		/*处理常规字段*/
		foreach($fields as $field => $position) {
			if( $position == 'first') {
				if( isset($basicData[$field]) ) {
					/*设置数据*/
					$redundanceData[$field][] = $basicData[$field];
				}
			}

			if( $position == 'table_first') {
				if( isset($basicData[$field]) ) {
					/*设置数据*/
					$redundanceData[$field][] = $basicData[$field];
				}
			}

			/*处理首页数据, 处理带有first_开头的数据*/
			if(starts_with($field, 'first_')) {
				$curField = str_replace('first_', '', $field);
				if( isset($basicData[$curField]) ) {
					/*设置数据*/
					$redundanceData[$field][] = $basicData[$curField];
				}
			}
		}


		/*处理额外拼接字段*/
		/*处理first_drug_name*/
		if( in_array('first_drug_name', array_keys($fields)) ) {
			$brandName = isset($basicData['brand_name']) && $basicData['brand_name'] ? $basicData['brand_name'] . '/' : '';
			$genericName = isset($basicData['generic_name']) ? $basicData['generic_name'] : '';
			$redundanceData['first_drug_name'][] =  $brandName . $genericName;
		}

		return $redundanceData;
	}

	/**
	 * 处理冗余的常规数据
	 * @return [type] [description]
	 */
	private function dealCommonRedundanceData($results, $fields, $redundanceData)
	{
		/*处理常规字段信息*/
		foreach($results as $result) {
			/*获取提交的数据*/
			if( $datas = $result['data'] ) {
				$basicData = array_except($datas, ['tables']);

				/*处理常规字段*/
				foreach($fields as $field => $position) {
					/*针对多列的数据*/
					if( $position == 'first') {
						continue;
					}
					if( isset($basicData[$field]) ) {
						$redundanceData[$field][] = $basicData[$field];
					}
				}

				/*处理额外拼接字段*/
				/*处理drug_name*/
				if( in_array('drug_name', array_keys($fields)) ) {
					$brandName = isset($basicData['brand_name']) && $basicData['brand_name'] ? $basicData['brand_name'] . '/' : '';
					$genericName = isset($basicData['generic_name']) ? $basicData['generic_name'] : '';
					$redundanceData['drug_name'][] =  $brandName . $genericName;
				}
			}
		}
		return $redundanceData;
	}

	/**
	 * 保存数据
	 * @param  [type] $results [description]
	 * @return [type]          [description]
	 */
	private function saveData($results, $companyId, $reportId, $reportTabId)
	{
		foreach($results as $result) {
			$colId = $result['col_id'];
			$colName = $result['col_name'] ?: '';

			/*字段数据*/
			$allData = $result['data'];
			$tableData = $allData['tables'];

			/*处理基础数据*/
			$attributes = [
				'company_id' => $companyId,
				'report_id' => $reportId,
				'report_tab_id' => $reportTabId,
				'col' => $colId,
				'deleted_at' => null,
			];

			$values = [
				'col_name' => $colName,
			];

			/*处理所有数据*/
			foreach($allData as $key => $info) {
				/*处理表格数据*/
				if($key == 'tables') {
					$this->saveTableData($info, $attributes, $values);
					continue;
				}

				/*处理基础数据*/
				$this->saveBasicData($key, $info, $attributes, $values);
			}
		}
	}

	private function saveBasicData($key, $value, $attributes, $values)
	{
		$attributes = array_merge($attributes, [
			'name' => $key,
			'table_row_id' => 0,
		]);

		$values = array_merge($values, [
			'value' => $value,
			'is_table' => getCommonCheckValue(false),
			'table_alias' => 0,
		]);

		$this->reportValueRepo->updateOrCreate($attributes, $values);
	}

	/*保存表格数据*/
	private function saveTableData($tables, $attributes, $values)
	{
		if($tables) {
			foreach($tables as $table) {
				$tableId = $table['table_id'];
				/*表格的数据*/
				if($tableValues = $table['values']) {
					foreach($tableValues as $row => $value) {
						if($value && is_array($value)) {
							foreach($value as $key => $val) {
								/*处理基础数据*/
								$attributes = array_merge($attributes, [
									'name' => $key,
									'table_row_id' => $row,
								]);

								$values = array_merge($values, [
									'value' => $val,
									'is_table' => getCommonCheckValue(true),
									'table_alias' => $tableId,
								]);

								$this->reportValueRepo->updateOrCreate($attributes, $values);
							}
						}
					}
				}
			}
		}
	}
}