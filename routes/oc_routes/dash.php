<?php

$router->group(['namespace' => 'Card'], function($router) {

    $router->resource('dash', 'DashController');
});