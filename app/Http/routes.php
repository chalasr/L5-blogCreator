<?php

Route::get('/', array('uses' => 'BlogsController@index', 'as' => 'home'));

//resources
Route::resource('blogs', 'BlogsController', ['except' => ['show', 'index']]);
Route::resource('posts', 'PostsController', ['except' => ['show', 'index']]);

//getting full blog post
Route::get('/post/{slug}', array('uses' => 'PostsController@getPost', 'as' => 'fullPost'));

//getting full blog post
Route::get('/blog/{slug}', array('uses' => 'BlogsController@showBlog', 'as' => 'fullBlog'));

//getting the login page
Route::get('/admin/login', array('uses' => 'AdminController@getLogin', 'as' => 'getLogin'));

//Logging in the user(admin)
Route::group(array('before' => 'csrf'), function()
{
	Route::post('/admin/login', array('uses' => 'AdminController@postLogin', 'as' => 'postLogin'));
});

Route::resource('comments', 'CommentsController');

//Dashboard which will be accessible only to admin
Route::group(array('middleware' => 'admin'), function()
{
	Route::get('/admin/dash', array('uses' => 'AdminController@getAdminDash', 'as' => 'adminDash'));
	Route::get('/admin/logout', array('uses' => 'AdminController@getLogout', 'as' => 'getLogout'));
	Route::get('/admin/delete/post/{id}', array('uses' => 'PostsController@deletePost', 'as' => 'deletePost'));
	Route::get('/admin/edit/post/{id}', array('uses' => 'PostsController@getEditPost', 'as' => 'getEditPost'));

});
