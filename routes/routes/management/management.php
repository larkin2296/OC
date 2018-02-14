<?php
$router->group([], function($router) {
    $router->group(['prefix' => 'management', 'as' => 'management.'], function ($router) {
        /*油卡管理*/
        $router->get('index', [
            'uses' => 'ManagementController@index',
            'as' => 'index'
        ]);
        /*油卡添加*/
        $router->post('create', [
            'uses' => 'ManagementController@create',
            'as' => 'create'
        ]);
        /*油卡删除*/
        $router->get('{id}/delete', [
            'uses' => 'ManagementController@delete',
            'as' => 'delete'
        ]);
        /*油卡状态修改*/
        $router->get('{id}/update', [
            'uses' => 'ManagementController@update',
            'as' => 'update'
        ]);
    });
    /*资源路由*/
    $router->resource('management', 'ManagementController');
});