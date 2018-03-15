<?php
/**
 * Created by PhpStorm.
 * User: xinxin.lv
 * Date: 2018/1/16
 * Time: 上午11:31
 */

$router->group([], function($router) {

    $router->group(['prefix' => 'postdrug', 'as' => 'postdrug.'], function($router) {
        /*菜单排序*/
        $router->post('sort', [
            'uses' => 'PostDrugController@sort',
            'as' => "sort"
        ]);

        //上市后
        $router->get('index', [
            'uses' => 'PostDrugController@postIndex',
            'as' => "index"
        ]);
        // 添加
        $router->get('add',[
            'uses' => 'PostDrugController@postCreate',
            'as' => "add"
        ]);
        // 修改
        $router->get('{id}/edit', [
            'uses' => 'PostDrugController@postEdit',
            'as' => "edit"
        ]);
        //删除
        $router->delete('{id}/remove',[
            'uses' => 'PostDrugController@remove',
            'as' => "remove"
        ]);
    });
});