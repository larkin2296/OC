<?php

$router->group([], function($router) {

    $router->group(['prefix' => 'list', 'as' => 'list.'], function($router) {
        $router->get('index', [
            'uses' => 'ListController@index',
            'as' => 'index'
        ]);
    });

});