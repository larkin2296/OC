<?php 

$router->group(['namespace' => 'Back'], function($router) {

	$router->resource('dash', 'DashController');
});