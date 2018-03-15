<?php 

$router->group(['namespace' => 'Workflow'], function($router) {

	/*工作流配置*/
	$router->group(['prefix' => 'workflow', 'as' => 'workflow.'], function($router){

		/*工作流配置*/
		$router->get('setting/{id}', [
			'uses' => 'WorkflowController@setting',
			'as' => 'setting',
		]);

		/*启用工作流*/
		$router->post('{id}/open', [
			'uses' => 'WorkflowController@open',
			'as' => 'open',
		]);

		/*工作流节点配置*/
		$router->resource('node', 'WorkflowNodeController');
	});

	$router->resource('workflow', 'WorkflowController');
});