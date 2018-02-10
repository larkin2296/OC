<?php 

$router->group([], function($router) {
	$router->group(['prefix' => 'role', 'as' => 'role.'], function($router) {
		/*角色用户*/
		$router->get('{id}/user/show', [
			'uses' => 'RoleController@userShow',
			'as' => 'user.show'
		]);

		/*修改角色权限*/
		$router->get('{id}/permission/edit', [
			'uses' => 'RoleController@permissionEdit',
			'as' => 'permission.edit'
		]);

		/*角色权限保存修改*/
		$router->put('{id}/permission', [
			'uses' => 'RoleController@permissionUpdate',
			'as' => 'permission.update'
		]);

		/*角色权限保存修改*/
		$router->get('organize/{organize_role_id}', [
			'uses' => 'RoleController@organize',
			'as' => 'organize'
		]);

	});

	$router->resource('role', 'RoleController');
});