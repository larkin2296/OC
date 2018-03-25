<?php

        $router->group(['prefix' => "backstage",'as' => 'backstage.'], function($router) {

//            $router->get('p_index',function (){
//                dd('123456');
//            })->name('p_index');

            $router->get('p_index',[
            'uses' => 'LeftMeauController@index',
            'as' => 'p_index'
            ]);
    });
