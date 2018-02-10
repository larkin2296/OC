<?php
$router->group([], function($router) {

    $router->group(['prefix' => 'mail', 'as' => 'mail.'], function($router){
        /*新增邮箱*/
    $router->post('create',[
        'uses'=>'MailController@create',
        'as'=>'create.',
    ]);
    });

    $router->resource('mail', 'MailController');
});