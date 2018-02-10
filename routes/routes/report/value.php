<?php 

$router->group(['prefix' => 'report/{reportid}', 'as' => 'report.'], function($router) {

	$router->group(['prefix' => 'value', 'as' => 'value.'], function($router){

		$router->get('reporttab/{reporttabid}/show', [
			'uses' => "ValueController@reportTabHtmlShow",
			'as' => 'reporttab.html.show',
		]);

		/*获取reporttab的html*/
		$router->get('reporttab/{reporttabid}', [
			'uses' => "ValueController@reportTabHtml",
			'as' => 'reporttab.html',
		]);

		/*保存报告详情数据*/
		$router->post('reporttab/{reporttabid}/save', [
			'uses' => "ValueController@save",
			'as' => 'reporttab.save',
		]);
	});

	$router->resource('value', 'ValueController');
});