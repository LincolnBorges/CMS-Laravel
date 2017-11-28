<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index');

Route::get('/post/{id}', ['as'=>'home.post', 'uses'=>'AdminPostsController@post']);

Route::get('/admin', function () {
    return view('admin.index');
});

Auth::routes();

Route::group(['middleware'=>'admin', 'as' => 'admin.'], function () {
    Route::resource('admin/users', 'AdminUsersController');
    Route::resource('admin/posts', 'AdminPostsController');
    Route::resource('admin/categories', 'AdminCategoriesController');
    Route::resource('admin/media', 'AdminMediaController');
    Route::resource('admin/comments', 'PostCommentsController');
    Route::post('admin/comments/activate/{id}', 'PostCommentsController@activate');
    Route::post('admin/replies/activate/{id}', 'CommentRepliesController@activate');
    Route::group(['as' => 'comment.'], function () {
        Route::resource('admin/comment/replies', 'CommentRepliesController');
    });
});

Route::group(['middleware'=>'auth', 'as' => 'admin.'], function () {
    Route::post('comment/reply', 'CommentRepliesController@createReply');
});
