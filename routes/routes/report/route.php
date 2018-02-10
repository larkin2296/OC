<?php 

$router->group(['namespace' => 'Back\Report'], function($router) {
    /*报告详情*/
	require(__DIR__ . '/value.php');
    #原始数据
    require(__DIR__ . '/source.php');
	/*报告任务*/
	require(__DIR__ . '/task.php');
	/*报告主页面*/
	require(__DIR__.'/mainpage.php');
	#上报监管
	require(__DIR__.'/supervision.php');
    #物流信息
    require(__DIR__.'/logistics.php');
});