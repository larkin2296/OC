<?php
$router->group(['namespace' => 'Back\Home\Registered'], function($router) {
    /*用户注册*/
    require(__DIR__ . '/login.php');

});