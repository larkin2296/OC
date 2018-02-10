<?php
$router->group(['prefix' => 'basic', 'as' => 'basic.'], function($router) {

    $router->group(['prefix' => 'enterprise', 'as' => 'enterprise.'], function ($router) {
        /*列表*/
        $router->get('index',[
            'uses'=>'EnterpriseController@index',
            'as'=>'index',
        ]);


    });



    $router->resource('enterprise','EnterpriseController');
});