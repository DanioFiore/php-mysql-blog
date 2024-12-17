<?php

require_once __DIR__ . '/app/components/Route.php';

// Define your routes
Route::get('posts', 'PostsController@index');
Route::get('posts/show', 'PostsController@show'); 
Route::post('admin/posts/store', 'AdminsController@store');

// pages
Route::get('', 'HomeController@index_view');
Route::get('admin/posts/index', 'PostsController@index_view');
Route::get('admin/posts/create', 'AdminsController@create_post_view');

Route::get('healthcheck', function() {
  echo 'OK';
});