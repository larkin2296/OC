<?php

$router->group([], function($router) {

    $router->group(['prefix' => 'purchasing', 'as' => 'purchasing.'], function($router) {

//        $router->get('index',function() {
//
//
//
//        });

        $router->get('index', [
            'uses' => 'KamiController@index',
            'as' => 'index'
        ]);


    });
    $router->resource('kami', 'KamiController');
});