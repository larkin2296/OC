<?php

$router->group([], function($router) {

    $router->group(['prefix' => 's_directly', 'as' => 's_directly.'], function($router) {
        $router->get('index', [
            'uses' => 'SupplierDirectlyController@index',
            'as' => 'index'
        ]);
    });

});