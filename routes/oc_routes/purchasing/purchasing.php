<?php

$router->group([], function($router) {

    $router->group(['prefix' => 'backstage', 'as' => 'backstage.'], function($router) {
            /*默认首页*/
            require(__DIR__ . '/c_recharge.php');
            require(__DIR__ . '/camilo.php');
            require(__DIR__ . '/d_recharge.php');
            require(__DIR__ . '/list.php');
            require(__DIR__ . '/oil_binding.php');
            require(__DIR__ . '/user_message.php');
        $router->get('message', [
            'uses' => 'MessageController@index',
            'as' => 'index'
        ]);


    });

});