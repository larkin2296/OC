<?php

$router->group([], function($router) {

    $router->group(['prefix' => 'oil_binding', 'as' => 'oil_binding.'], function($router) {
        $router->get('index', [
            'uses' => 'OilCardBindingController@index',
            'as' => 'index'
        ]);
    });

});