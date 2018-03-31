<?php

$router->group([], function($router) {

    $router->group(['prefix' => 'c_recharge', 'as' => 'c_recharge.'], function($router) {
        $router->get('index', [
            'uses' => 'CamiloRechargeController@index',
            'as' => 'index'
        ]);
    });

});