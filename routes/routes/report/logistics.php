<?php
/**
 * Created by PhpStorm.
 * User: lvxinxin
 * Date: 2018/02/05
 * Email: 1009@maschen.cc
 */


$router->group([], function($router) {
    $router->group(['prefix' => 'logistics', 'as' => 'logistics.'], function($router) {
        #物流列表
        $router->get('lists/{id}', [
            'uses' => 'LogisticsController@lists',
            'as' => "lists"
        ]);
        #其它形式的上报
        $router->match(['get','post'],'other/{id}', [
            'uses' => 'SupervisionsController@other',
            'as' => "other"
        ]);

        #无需上报
        $router->post('no-need/{id}', [
            'uses' => 'SupervisionsController@noNeed',
            'as' => "no-need"
        ]);
    });
    $router->resource('logistics', 'LogisticsController');
});