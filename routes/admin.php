<?php

Route::prefix('system')->namespace('Backend\System')->group(function($api){
    $api->get('admin_user','AdminUserController@getAdminUserList');
});

Route::prefix('auth')->namespace('\Backend\Auth')->group(function($api){
    $api->post('login','AdminController@Login');
    $api->get('info','AdminController@getUserInfo');
    $api->post('create','RegisterController@create');
});

Route::namespace('Backend')->group(function () {
    Route::prefix('article')->group(function(){
        Route::get('list','ArticleController@getList');
    });

    Route::prefix('category')->group(function($api){
        $api->get('list','CategoryController@getList');
    });
});


