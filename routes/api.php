<?php

use Illuminate\Http\Request;


Route::resource('post', 'Api\PostController')->only(['index', 'show']);
Route::post('register', 'Api\Auth\RegisterController@register');
Route::post('login', 'Api\Auth\LoginController@login');
Route::post('refresh', 'Api\Auth\LoginController@refresh');


Route::group(['middleware' => ['auth:api']], function () {
    Route::get('logout', 'Api\Auth\LoginController@logout');
    Route::resource('post', 'Api\PostController')->only(['store', 'update', 'destroy']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});