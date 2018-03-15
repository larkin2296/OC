<?php
$router->group(['namespace' => 'Back\Homepage'], function($router) {

    /*报告任务*/
//    require(__DIR__.'/Presentation.php');
    /*质疑任务*/
    require(__DIR__ . '/questioning.php');
});
