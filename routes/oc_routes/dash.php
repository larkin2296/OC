<?php

$router->group(['namespace' => 'OcBack'], function($router) {

    $router->resource('dash', 'DashController');
});