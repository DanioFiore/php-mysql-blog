<?php

require_once __DIR__ . '/app/components/Route.php';

// Routes

// posts
Route::get('user/posts', 'PostsController@showUserPosts');
Route::post('posts', 'AdminsController@store');

// users
Route::post('users/signup', 'UsersController@store');
Route::post('users/login', 'UsersController@login');
Route::get('users/logout', 'UsersController@logoutUser');

// pages
Route::get('', 'SiteController@home');
Route::get('posts', 'SiteController@indexPosts');
Route::get('signup', 'SiteController@signup'); 
Route::get('login', 'SiteController@login');
Route::get('posts', 'PostsController@index');
Route::get('posts/create', 'SiteController@createPost');



// TODO: to implement
Route::get('posts/{id}', 'PostsController@show'); 
Route::delete('posts/{id}', 'PostsController@destroy');


Route::get('healthcheck', function() {
  echo 'OK';
});