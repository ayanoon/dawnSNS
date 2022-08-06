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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login');
Route::get('/', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');


//ログイン中のページ
Route::get('/top', 'PostsController@index');
Route::post('/top', 'PostsController@index');
Route::post('/top', 'PostsController@post');

Route::get('/top/{id}/update-form', 'PostsController@updateForm');
Route::post('/top/update', 'PostsController@update');

Route::get('/top/{id}/delete', 'PostsController@delete');

Route::post('/top/create', 'PostsController@create');

Route::get('/profile', 'UsersController@profile');
Route::post('/profile', 'UsersController@update');

Route::get('/search', 'UsersController@search');
Route::post('/result', 'UsersController@result');

Route::get('/followlist', 'UsersController@followlist');
Route::get('/followerlist', 'UsersController@followerlist');

Route::post('/follow/create', 'FollowsController@create');
Route::post('/follow/delete', 'FollowsController@delete');
