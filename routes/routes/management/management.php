<?php
$router->group([], function($router) {
    $router->group(['prefix' => 'management', 'as' => 'management.'], function ($router) {
        /*油卡管理*/
//        $router->get('index', [
//            'uses' => 'ManagementController@index',
//            'as' => 'index'
//        ]);
        $router->get('index', function(){
            dd(122);
});
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

        /*excel*/
        $router->get('excel', [
            'uses' => 'ManagementController@excel',
            'as' => 'excel'
        ]);
    });
    /*资源路由*/
    $router->resource('management', 'ManagementController');
});