<?php

$router->group([], function($router) {

    $router->group(['prefix' => 'backstage', 'as' => 'backstage.'], function($router) {

        $router->get('camilo', [
            'uses' => 'CamiloController@index',
            'as' => 'index'
        ]);
        $router->get('c_recharge', [
            'uses' => 'CamiloRechargeController@index',
            'as' => 'index'
        ]);
        $router->get('d_recharge', [
            'uses' => 'DirectlyRechargeController@index',
            'as' => 'index'
        ]);
        $router->get('list', [
            'uses' => 'ListController@index',
            'as' => 'index'
        ]);
        $router->get('message', [
            'uses' => 'MessageController@index',
            'as' => 'index'
        ]);
        $router->get('user_message', [
            'uses' => 'UserMessageController@index',
            'as' => 'index'
        ]);
        $router->get('oil_binding', [
            'uses' => 'OilCardBindingController@index',
            'as' => 'index'
        ]);


    });

});