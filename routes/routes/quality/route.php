<?php
$router->group(['namespace' => 'Back\Quality'], function($router) {

    require(__DIR__.'/question.php');

    require(__DIR__.'/datatrace.php');

});
