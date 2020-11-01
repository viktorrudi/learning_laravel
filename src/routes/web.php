<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return '{}';
});

Route::get('/token', 'App\Http\Controllers\PostsController@token');

//Route::resource('posts', 'App\Http\Controllers\PostsController');
Route::get('/posts', 'App\Http\Controllers\PostsController@index');
Route::get('/posts/{id}', 'App\Http\Controllers\PostsController@index');
Route::post('/posts', 'App\Http\Controllers\PostsController@store');
Route::post('/posts/update/{id}', 'App\Http\Controllers\PostsController@update');
Route::post('/posts/delete/{id}', 'App\Http\Controllers\PostsController@destroy');

