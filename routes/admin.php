<?php

Route::prefix('system')->namespace('Backend\System')->group(function($api){
    $api->get('admin_user','AdminUserController@getAdminUserList');
});

Route::prefix('auth')->namespace('\Backend\Auth')->group(function($api){
    $api->post('login','AdminController@Login');
    $api->post('create','RegisterController@create');
});

Route::middleware('checkToken')->group(function () {

    Route::prefix('auth')->namespace('\Backend\Auth')->group(function($api){
        $api->get('info','AdminController@getUserInfo');
        $api->post('logout','AdminController@logout');
    });


    Route::namespace('Backend')->group(function () {
        Route::prefix('article')->group(function(){
            Route::get('list','ArticleController@getList');
            Route::post('save','ArticleController@save');
            Route::get('info','ArticleController@info');
        });

        Route::prefix('category')->group(function($api){
            $api->get('list','CategoryController@getList');
        });
    });
});



