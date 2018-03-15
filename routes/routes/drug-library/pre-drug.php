<?php
/**
 * Created by PhpStorm.
 * User: xinxin.lv
 * Date: 2018/1/16
 * Time: 上午11:31
 */

$router->group([], function($router) {

    $router->group(['prefix' => 'predrug', 'as' => 'predrug.'], function($router) {
        //上市前
        //列表页
        $router->get('index', [
            'uses' => 'PreDrugController@preIndex',
            'as' => "index"
        ]);
        // 添加
        $router->get('add',[
            'uses' => 'PreDrugController@preCreate',
            'as' => "add"
        ]);
        // 修改
        $router->get('{id}/edit', [
            'uses' => 'PreDrugController@preEdit',
            'as' => "edit"
        ]);
        //删除
        $router->delete('{id}/remove',[
            'uses' => 'PreDrugController@remove',
            'as' => "remove"
        ]);
    });
});