<?php
$router->group(['namespace'=>'Card\Index'], function($router) {

    /*采购商首页*/
    require(__DIR__.'/p_index.php');
    /*供应商首页*/
    require(__DIR__.'/s_index.php');

});