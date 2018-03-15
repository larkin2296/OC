<?php
/**
 * Created by PhpStorm.
 * User: xinxin.lv
 * Date: 2018/1/23
 * Time: 下午4:57
 */

$router->group([], function($router) {

    $router->group(['prefix' => 'cate', 'as' => 'cate.'], function($router) {


    });
    $router->resource('cate', 'CategoryController');
});