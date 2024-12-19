<?php

require_once __DIR__ . '/app/components/Route.php';

// Routes

// posts
Route::get('user/posts', 'PostsController@showUserPosts');
Route::get('posts/show', 'PostsController@show'); 
Route::delete('posts', 'PostsController@destroy');
Route::post('admin/posts/store', 'AdminsController@store');

// users
Route::post('users/signup', 'UsersController@store');
Route::get('users/logout', 'UsersController@logoutUser');

// pages
Route::get('posts', 'PostsController@index');
Route::get('', 'HomeController@indexView');
Route::get('admin/posts/index', 'PostsController@index');
Route::get('admin/posts/create', 'AdminsController@createPostView');
Route::get('users/signup', 'UsersController@signupView'); 
Route::get('users/login', 'UsersController@loginView');
Route::post('users/login_user', 'UsersController@login');


Route::get('healthcheck', function() {
  echo 'OK';
});