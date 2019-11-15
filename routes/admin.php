<?php

Route::prefix('system')->namespace('Backend\System')->group(function($api){
    $api->get('admin_user','AdminUserController@getAdminUserList');
});

Route::prefix('auth')->namespace('\Backend\Auth')->group(function($api){
    $api->post('login','AdminController@Login');
    $api->get('info','AdminController@getUserInfo');
});


Route::prefix('article')->namespace('Backend')->group(function($api){
    $api->get('list','ArticleController@getList');
});