<?php 

$router->group([], function($router) {

	$router->group(['prefix' => 'user', 'as' => 'user.'], function($router){
		/*重置密码*/
		$router->put('resetpass/{id}', [
			'uses' => 'UserController@resetPass',
			'as' => 'pass.reset'
		]);

		/*锁定用户*/
		$router->put('lock/{id}', [
			'uses' => 'UserController@lock',
			'as' => 'lock'
		]);

		/*解锁用户*/
		$router->put('unlock/{id}', [
			'uses' => 'UserController@unlock',
			'as' => 'unlock'
		]);
	});

	$router->resource('user', 'UserController');
});