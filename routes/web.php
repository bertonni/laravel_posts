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

// Post's actions
Route::get('/posts', 'PostsController@add');
Route::post('/posts', 'PostsController@create');
Route::get('/post/{post}', 'PostsController@viewPost');

Auth::routes();

// Comments's actions
Route::post('/', 'CommentsController@create');
Route::get('/edit/{comment}/{post}', 'CommentsController@edit');
Route::post('/update/{comment}', 'CommentsController@update');
Route::get('/delete/{comment}', 'CommentsController@delete');

Route::get('/up/{comment}', 'CommentsController@upvote');
Route::get('/down/{comment}', 'CommentsController@downvote');

// Categories's actions
Route::get('/addCategory', 'CategoriesController@add');
Route::post('/addCategory', 'CategoriesController@create');

// Users's actions
Route::get('/profile/{user}', 'UsersController@profile');
Route::post('/profile', 'UsersController@update');
Route::get('/search', 'UsersController@search');

// Home's actions
Route::get('/', 'HomeController@index');
Route::post('/lang' , 'HomeController@changeLocale');