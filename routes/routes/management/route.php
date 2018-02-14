<?php
$router->group(['namespace' => 'Back\Home\Management'], function($router) {
    //油卡管理
    require(__DIR__.'/management.php');
    //卡密采购
    require(__DIR__.'/purchase.php');
});
