<?php
/**
 * Created by PhpStorm.
 * User: xinxin.lv
 * Date: 2018/1/17
 * Time: 上午10:39
 */
$router->group(['namespace' => 'Back\DrugLibrary'], function($router) {

    // 药品-上市前/上市后
    require(__DIR__ . '/drug.php');
    // 药品上市前
    require(__DIR__ . '/pre-drug.php');
    // 药品上市后
    require(__DIR__ . '/post-drug.php');
});