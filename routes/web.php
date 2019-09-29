<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/post/new', 'PostsController@new')->name('new_post');
Route::post('/post/new', 'PostsController@create')->name('create_post');
Route::get('/post/show', 'PostsController@show')->name('show_post');
Route::get('/post/show/{username}', 'PostsController@showbyusername')->name('show_post_');
Route::get('/post/{post}', 'PostsController@show_single')->name('show_single');
Route::get('post/{post}/edit', 'PostsController@edit_post')->name('edit_post');
Route::put('/post/{post}/edit', 'PostsController@update_post')->name('edit_post');
Route::delete('/post/{post}/delete', 'PostsController@delete_post')->name('delete_post');
Route::post('/delete', 'UserController@destroy')->name('delete');
Route::resource('comments', 'CommentController');
Route::get('/contact', 'ContactController@create')->name('contact.create');
Route::post('/contact', 'ContactController@send')->name('contact.send');
Route::get('/search/:keywords', 'SearchController@search' )->name("search.create");
Route::middleware('admin')->prefix('admin')->namespace("Admin")->group(function(){
   Route::get('/', 'AdminController@index')->name('admin.index');
   Route::get('/users', 'UserController@index')->name('users.index');
   Route::get('/posts', 'PostController@index')->name('posts.index');
   Route::get('/comments', 'CommentController@index')->name('comments.index');
   Route::put('/deactivate/{user}', 'UserController@deactivate')->name('users.deactivate');
   Route::put('/activate/{user}', 'UserController@activate')->name('users.activate');
   Route::put('/admin/{user}', 'UserController@roles')->name('users.role');
});
