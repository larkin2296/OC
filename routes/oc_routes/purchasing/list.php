<?php

$router->group(['namespace'=>'Card\Purchasing'], function($router) {

    $router->group(['prefix' => 'list', 'as' => 'list.'], function($router) {
        $router->get('index', [
            'uses' => 'ListController@index',
            'as' => 'index'
        ]);
    });
    $router->get('message', [
        'uses' => 'MessageController@index',
        'as' => 'index'
    ]);

});