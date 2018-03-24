<?php

$router->group(['namespace'=>'Card\Index'], function($router) {

    $router->group(['prefix' => 'backstage', 'as' => 'backstage.'], function($router) {

        $router->get('p_index', [
            'uses' => 'LeftMeauController@index',
            'as' => 'index'
        ]);


    });
});