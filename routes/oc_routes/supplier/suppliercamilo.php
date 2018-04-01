<?php

$router->group(['namespace'=>'Card\Supplier'], function($router) {

    $router->group(['prefix' => 's_camilo', 'as' => 's_camilo.'], function($router) {
        $router->get('index', [
            'uses' => 'SupplierCamiloController@index',
            'as' => 'index'
        ]);
    });

});