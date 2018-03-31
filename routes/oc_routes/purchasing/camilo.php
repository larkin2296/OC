<?php

$router->group([], function($router) {

    $router->group(['prefix' => 'camilo', 'as' => 'camilo.'], function($router) {
        $router->get('index', [
            'uses' => 'CamiloController@index',
            'as' => 'index'
        ]);
    });

});