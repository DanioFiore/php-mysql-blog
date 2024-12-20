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
Route::post('users/login', 'UsersController@login');

// pages
Route::get('', 'SiteController@home');
Route::get('posts', 'SiteController@indexPosts');
Route::get('signup', 'SiteController@signup'); 
Route::get('login', 'SiteController@login');
Route::get('admin/posts/index', 'PostsController@index');
Route::get('admin/posts/create', 'AdminsController@createPostView');

// TODO: to implement

Route::get('healthcheck', function() {
  echo 'OK';
});