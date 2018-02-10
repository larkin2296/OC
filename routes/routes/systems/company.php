<?php 

$router->group([], function($router) {

	$router->group(['prefix' => 'company', 'as' => 'company.'], function($router){
		
		/*切换公司*/	
		$router->get('{company}/exchange', [
			'middleware' => 'exchange.company',
			'uses' => 'CompanyController@exchange',
			'as' => 'exchange',
		]);
	});

	$router->resource('company', 'CompanyController');
});