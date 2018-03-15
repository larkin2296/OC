<?php
$router->group(['prefix' => 'report', 'as' => 'report.'], function($router) {

    $router->group(['prefix' => 'mainpage', 'as' => 'mainpage.'], function ($router) {
        /*列表*/
        $router->any('index',[
            'uses'=>'MainpageController@index',
            'as'=>'index',
        ]);
        /*新建*/
        $router->post('create',[
            'uses'=>'MainpageController@create',
            'as'=>'create',
        ]);
        /*复制*/
         $router->get('{id}/copy',[
            'uses'=>'MainpageController@copy',
             'as'=>'copy',
         ]);
         /*删除*/
         $router->get('{id}/edit',[
             'uses'=>'MainpageController@edit',
             'as'=>'edit',
         ]);
        /*导出*/
        $router->get('{id}/export',[
            'uses'=>'MainpageController@export',
            'as'=>'export',
        ]);

        /*新建版本*/
        $router->get('{id}/build',[
            'uses'=>'MainpageController@build',
            'as'=>'build',
        ]);

        /*查看详情*/
        $router->get('{id}/show',[
           'uses'=>'MainpageController@show',
            'as'=>'show',
        ]);
        /*查看详情*/
        $router->get('{id}/newreport',[
            'uses'=>'MainpageController@newreport',
            'as'=>'newreport',
        ]);
    });

    $router->resource('mainpage','MainpageController');
});