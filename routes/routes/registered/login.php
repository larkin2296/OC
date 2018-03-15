<?php
$router->group(['prefix' => 'registered', 'as' => 'registered.'], function($router) {

    $router->group(['prefix' => 'login', 'as' => 'login.'], function ($router) {
        /*列表*/
        $router->get('index',[
            'uses'=>'LoginController@index',
            'as'=>'index',
        ]);


    });



    $router->resource('login','LoginController');
});