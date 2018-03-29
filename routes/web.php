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

    Auth::routes();

    $router->group(['middleware' => ['auth']], function ($router) {
        /*默认首页*/
        $router->get('/',[
            'uses' => 'Card\DashController@index',
            'as' => 'index',
        ]);

        $router->get('home',[
        'uses' => 'Card\DashController@index',
        'as' => 'index',
       ])->name('home');

            $router->get('create',function (){
                    dd(123);
            })->name('create');


    $router->group(['prefix' => 'admin', 'as' => 'admin.',], function ($router) {
        /*默认首页*/
        require(__DIR__ . '/oc_routes/dash.php');
        /*后台首页*/
        require(__DIR__ . '/oc_routes/backstage/route.php');
        /*采购商*/
        require(__DIR__ . '/oc_routes/purchasing/route.php');



    });
  });



});



