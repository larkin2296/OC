<?php
$router->group([], function($router) {
    $router->group(['prefix' => 'purchase', 'as' => 'purchase.'], function ($router) {
        /*卡密采购管理*/
        $router->get('index', [
            'uses' => 'ManagementController@index',
            'as' => 'index'
        ]);
    });
});