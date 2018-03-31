<?php

$router->group(['prefix' => "backstage",'as' => 'backstage.'], function($router) {

    $router->get('s_index',[
        'uses' => 'SupplierMeauController@index',
        'as' => 's_index'
    ]);
});