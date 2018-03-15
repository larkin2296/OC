<?php
$router->group([], function($router) {
    $router->group(['prefix' => 'question', 'as' => 'question.'], function($router){
        /*质疑管理*/
        /*查看tab详情页面*/
        $router->put('{id}/show',[
            'uses' => 'QuestionController@show',
            'as' => 'show'
        ]);
    });
/*资源路由*/
	$router->resource('question', 'QuestionController');
});