<?php

Route::namespace('Frontend')->group(function(){

    Route::prefix('/article')->group(function(){
        Route::get('/','ArticleController@getList');
    });
});
