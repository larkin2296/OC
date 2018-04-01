<?php

$router->group(['namespace'=>'Card\Purchasing'], function($router) {

    $router->group(['prefix' => 'user_message', 'as' => 'user_message.'], function($router) {
        $router->get('index', [
            'uses' => 'UserMessageController@index',
            'as' => 'index'
        ]);
    });

});