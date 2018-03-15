<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
 * ============ API ============ 
 * 周文
 * https://documenter.getpostman.com/view/159564/pvhsky/7LuaenB
 *
 * 刘通
 * https://documenter.getpostman.com/view/3528973/pv-/7TKgsPx
 *
 * 吕新新
 * https://documenter.getpostman.com/view/3537275/medsci-pv-/7TRdqGn
 *
 * 原型
 * https://qtx480.axshare.com/
 * ============ END ============ 
 */

/*网站中间键*/
$router->group(['middleware' => "web"], function($router) {
	/*设置语言*/
	$router->get('language/{language}', [
		'uses' => "LanguageController@set",
		'as' => 'language'
	]);
<<<<<<< HEAD
	$router->group(['prefix' => 'admin', 'as' => 'admin.','middleware' => ['auth']], function($router) {
	    /*默认首页*/
	    require(__DIR__.'/oc_routes/dash.php');
        /*采购商*/
        require(__DIR__ . '/oc_routes/management/route.php');
=======
	// 'middleware' => ['auth'] 关闭auth lt测试
	$router->group(['prefix' => 'admin', 'as' => 'admin.','middleware' => ['auth']], function($router) {
	    /*默认首页*/
	    require(__DIR__.'/routes/dash.php');
	    /*用户信息*/
		require(__DIR__ . '/routes/registered/route.php');
        /*油卡管理*/
        require(__DIR__ . '/routes/management/route.php');
>>>>>>> daab3c90c5bd55c22d3d2437ec68cbb8ec77370e


    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

