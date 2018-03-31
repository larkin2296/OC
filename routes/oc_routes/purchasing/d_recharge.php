<?php

$router->group([], function($router) {

    $router->group(['prefix' => 'd_recharge', 'as' => 'd_recharge.'], function($router) {
        $router->get('index', [
            'uses' => 'DirectlyRechargeController@index',
            'as' => 'index'
        ]);
    });

});