<?php
$router->group(['namespace'=>'Card\Index'], function($router) {

    /*后台首页*/
    require(__DIR__.'/backstage.php');

});