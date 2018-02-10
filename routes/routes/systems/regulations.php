<?php
/**
 * Created by PhpStorm.
 * User: xinxin.lv
 * Date: 2018/1/18
 * Time: 下午7:06
 */

$router->group([], function($router) {

    $router->group(['prefix' => 'rule', 'as' => 'rule.'], function($router) {
        
    });
    $router->resource('rule', 'RegulationsController');
});