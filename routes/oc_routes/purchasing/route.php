<?php

$router->group(['namespace'=>'Card\Purchasing'], function($router) {
    //采购商
    require(__DIR__.'/purchasing.php');

});
//$router->group(['namespace' => 'Back\System'], function($router) {
//    /*用户*/
//    require(__DIR__ . '/user.php');
//    /*角色*/
//    require(__DIR__ . '/role.php');
//    /*权限*/
//    require(__DIR__ . '/permission.php');
//    /*菜单*/
//    require(__DIR__ . '/menu.php');
//    /*字典管理*/
//    require(__DIR__ . '/dictionaries.php');
//    /*工作流*/
//    require(__DIR__ . '/workflow.php');
//    /*公司*/
//    require(__DIR__ . '/company.php');
//
//    /*邮箱管理*/
//    require(__DIR__.'/mail.php');
//    #报告规则
//    require(__DIR__ . '/regulations.php');
//    #通用分类
//    require(__DIR__ . '/category.php');
//
//});