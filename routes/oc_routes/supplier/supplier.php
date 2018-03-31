<?php

$router->group([], function($router) {

    $router->group(['prefix' => 'backstage', 'as' => 'backstage.'], function($router) {
        /*默认首页*/
        require(__DIR__ . '/supplierlist.php');
        require(__DIR__ . '/suppliercamilo.php');
        require(__DIR__ . '/supplierdirectly.php');

    });

});