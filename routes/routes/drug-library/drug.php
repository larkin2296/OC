<?php
/**
 * Created by PhpStorm.
 * User: xinxin.lv
 * Date: 2018/1/16
 * Time: 上午11:31
 */

$router->group([], function($router) {
    $router->group(['prefix' => 'drug', 'as' => 'drug.'], function($router) {
        $router->resource('drug', 'DrugController');
    });
});
    