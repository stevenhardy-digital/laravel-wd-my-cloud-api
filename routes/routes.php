<?php


Route::group(['middleware' => 'web'], function () {
    Route::get('auth', 'AuthController@auth');
});