<?php

$router->group(['namespace'=>'Card\Supplier'], function($router) {

    $router->group(['prefix' => 's_list', 'as' => 's_list.'], function($router) {
        $router->get('index', [
            'uses' => 'SupplierListController@index',
            'as' => 'index'
        ]);
    });

});