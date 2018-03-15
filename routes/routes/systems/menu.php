<?php 

$router->group([], function($router) {

	$router->group(['prefix' => 'menu', 'as' => 'menu.'], function($router) {
		/*菜单排序*/
		$router->post('sort', [
			'uses' => 'MenuController@sort',
			'as' => "sort"
		]);
	});
	$router->resource('menu', 'MenuController');
});