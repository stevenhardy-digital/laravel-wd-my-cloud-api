<?php


Route::group(['middleware' => 'web'], function () {
    Route::get('login', ['as' => 'login', 'uses' => 'AuthController@redirectToProvider']);
    Route::get('login_callback', ['as' => 'login', 'uses' => 'AuthController@handleProviderCallback']);

});