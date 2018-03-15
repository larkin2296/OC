<?php

$router->group([], function($router) {
    $router->group(['prefix' => 'dictionaries', 'as' => 'dictionaries.'], function($router){
        $router->get('search/{page?}/{keyword?}',[
            'uses'=>'DictionariesController@search',
            'as'=>'search',
        ]);
        $router->get('subup/{id}',[
           'uses'=>'DictionariesController@fieldUp',
            'as'=>'subup'
        ]);
        $router->post('create',[
            'uses'=>'DictionariesController@create',
            'as'=>'create',
        ]);
        $router->get('hasmanydictionaries',[
            'uses'=>'DictionariesController@hasmanydictionaries',
            'as'=>'hasManyDictionaries',
        ]);
    });
    //资源控制器
    $router->resource('dictionaries', 'DictionariesController');
});
?>