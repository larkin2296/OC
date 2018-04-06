<?php

$router->group(['namespace'=>'Card\Supplier'], function($router) {

    $router->group(['prefix' => 's_list', 'as' => 's_list.'], function($router) {

        //订单查询
        $router->get('index', [
            'uses' => 'SupplierListController@index',
            'as' => 'index'
        ]);
        //用户信息页面
        $router->get('show', [
            'uses' => 'SupplierListController@show',
            'as' => 'show'
        ]);
        //修改用户信息
        $router->get('store', [
            'uses' => 'SupplierListController@store',
            'as' => 'store'
        ]);
        //卡密订单页面
        $router->get('cardencry', [
            'uses' => 'SupplierListController@cardencry',
            'as' => 'cardencry'
        ]);
        //卡密订单上传
        $router->post('create', [
            'uses' => 'SupplierListController@create',
            'as' => 'create'
        ]);

    });

});