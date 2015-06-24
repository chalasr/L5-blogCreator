<?php
Route::get('/', array('uses' => 'HomeController@index', 'as' => 'home'));

//getting full blog post

Route::get('/post/{slug}', array('uses' => 'PostController@getPosts', 'as' => 'fullPost'));

//getting the login page 

Route::get('/admin/login', array('uses' => 'AdminController@getLogin', 'as' => 'getLogin'));

//Logging in the user(admin)

Route::group(array('before' => 'csrf'), function()
{
	Route::post('/admin/login', array('uses' => 'AdminController@postLogin', 'as' => 'postLogin'));
});

//Dashboard which will be accessible only to admin

Route::group(array('middleware' => 'admin'), function()
{
	Route::get('/admin/dash', array('uses' => 'AdminController@getAdminDash', 'as' => 'adminDash'));

	Route::get('/admin/logout', array('uses' => 'AdminController@getLogout', 'as' => 'getLogout'));

	Route::get('/admin/delete/post/{id}', array('uses' => 'AdminController@deletePost', 'as' => 'deletePost'));

	Route::get('/admin/edit/post/{id}', array('uses' => 'AdminController@getEditPost', 'as' => 'getEditPost'));

	Route::group(array('before' => 'csrf'), function()
	{
		Route::post('/admin/store/post', array('uses' => 'AdminController@storePost', 'as' => 'storePost'));

		Route::post('/admin/edit/post/{id}', array('uses' => 'AdminController@editPost', 'as' => 'editPost'));

	});

});