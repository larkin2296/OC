<?php

$router->group([], function($router) {

    $router->group(['prefix' => 'backstage', 'as' => 'backstage.'], function($router) {
        /*默认首页*/
        require(__DIR__ . '/purchasing/c_recharge.php');
        require(__DIR__ . '/purchasing/camilo.php');
        require(__DIR__ . '/purchasing/d_recharge.php');
        require(__DIR__ . '/purchasing/list.php');
        require(__DIR__ . '/purchasing/oil_binding.php');
        require(__DIR__ . '/purchasing/user_message.php');
        require(__DIR__ . '/supplier/supplierlist.php');
        require(__DIR__ . '/supplier/suppliercamilo.php');
        require(__DIR__ . '/supplier/supplierdirectly.php');



    });

});