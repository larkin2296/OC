<?php
$router->group([], function($router) {
    $router->group(['prefix' => 'questioning', 'as' => 'questioning.'], function($router){
        /*发送质疑页面*/
        $router->get('{id}/open',[
            'uses'=>'QuestioningController@open',
            'as'=>'open',
        ]);
        /*发送质疑*/
        $router->post('create',[
            'uses'=>'QuestioningController@create',
            'as'=>'create',
        ]);
        /*关闭质疑*/

        $router->put('{id}/close',[
            'uses'=>'QuestioningController@close',
            'as'=>'close',
        ]);

        /*查看tab详情页*/
        $router->put('{id}/tabs', [
            'uses' => 'QuestionController@tabs',
            'as' => 'tabs'
        ]);
    });
    /*资源路由*/
    $router->resource('questioning', 'QuestioningController');
    //create show destroy
});