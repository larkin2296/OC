<?php
/**
 * Created by PhpStorm.
 * User: lvxinxin
 * Date: 2018/02/01
 * Email: 1009@maschen.cc
 */

$router->group([], function($router) {

    $router->group(['prefix' => 'supervision', 'as' => 'supervision.'], function($router) {
        #立即上报
        $router->post('immediately/{id}', [
            'uses' => 'SupervisionsController@immediately',
            'as' => "immediately"
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
    $router->resource('supervision', 'SupervisionsController');
});