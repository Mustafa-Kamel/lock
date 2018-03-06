<?php


Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
	Route::get('/', function () {
	    return view('welcome');
	});

	Auth::routes();

	Route::get('/home', 'HomeController@index')->name('home');

	Route::get('/home', function () {
	    return view('blog.home');
	});

	Route::group(['middleware' => ['auth']], function () {
	    Route::resource('post', 'PostController')->except(['index', 'show', 'userPosts']);
	});

	Route::get('posts/user/{user}', 'PostController@userPosts')->name('post.user');
	Route::resource('post', 'PostController')->only(['index', 'show', 'userPosts']);
	Route::resource('category', 'CategoryController');
});