<?php

$router->group(['namespace' => 'Back\Basic'], function($router) {
    /*企业信息*/
    require(__DIR__ . '/enterprise.php');

});