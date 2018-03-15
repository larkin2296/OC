<?php

/**
 * 稽查管理
 */
$router->group([], function($router) {

	$router->resource('datatrace', 'DataTraceController');
});