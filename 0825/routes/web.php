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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/now', function (){
	return '为彪哥报时:' . date('Y-m-d H:i:s');
});


Route::group(['middleware' => 'auth', 'namespace' => 'Admin', 'prefix' => 'admin'], function (){
    Route::get('/', 'HomeController@index');
    Route::resource('/article', 'ArticleController');
});

Route::get('article/{id}', 'ArticelController@show');

Route::post('comment', 'CommentController@store');
