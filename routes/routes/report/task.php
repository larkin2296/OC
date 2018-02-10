<?php 

$router->group(['prefix' => 'report', 'as' => 'report.', 'middleware' => 'ishaschoice.company'], function($router) {

	$router->group(['prefix' => 'task', 'as' => "task."], function($router){

		$router->group(['prefix' => '{id}', 'namespace' => 'Task'], function($router){
			/*报告任务重新分发*/
			$router->resource('reassign', 'ReassignController');

			/*报告任务-新建版本*/
			$router->resource('newversion', 'NewVersionController');
			
			/*报告任务-关联*/
			$router->resource('relevance', 'RelevanceController');
		});


	});

	$router->resource('task', 'TaskController');
});