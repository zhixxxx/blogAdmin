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
            Route::post('del','ArticleController@del');
        });

        Route::prefix('label')->group(function($api){
            $api->get('list','LabelController@getList');
            $api->post('save','LabelController@save');
            $api->post('del','LabelController@del');
        });

        Route::prefix('navigation')->group(function($api){
            $api->get('list','NavController@getList');
            $api->post('save','NavController@save');
            $api->post('del','NavController@del');
        });
    });
});



