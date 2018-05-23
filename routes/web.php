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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/posts', 'PostsController@add');
Route::post('/posts', 'PostsController@create');

Route::get('/post/{post}', 'PostsController@viewPost');

Auth::routes();

Route::post('/', 'CommentsController@create');
Route::get('/edit/{comment}/{post}', 'CommentsController@edit');
Route::post('/update/{comment}', 'CommentsController@update');
Route::get('/delete/{comment}', 'CommentsController@delete');

Route::get('/addCategory', 'CategoriesController@add');
Route::post('/addCategory', 'CategoriesController@create');

Route::get('/', 'HomeController@index');
