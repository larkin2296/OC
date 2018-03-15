<?php
/**
 * Created by PhpStorm.
 * User: xinxin.lv
 * Date: 2018/1/29
 * Time: 上午10:37
 */

$router->group([], function($router) {

    $router->group(['prefix' => 'source', 'as' => 'source.'], function($router) {
        #下载原始资料
        $router->get('download/{id}', [
            'uses' => 'SourcesController@download',
            'as' => "download"
        ]);

        #分发原始资料
//        $router->get('issue/{id}', [
//            'uses' => 'SourcesController@issue',
//            'as' => "issue"
//        ]);

        $router->match(['get','post'],'issue/{id}', [
            'uses' => 'SourcesController@issue',
            'as' => "issue"
        ]);

        #回收原始资料
        $router->get('recycling/{id}', [
            'uses' => 'SourcesController@recycling',
            'as' => "recycling"
        ]);
    });
    $router->resource('source', 'SourcesController');
});