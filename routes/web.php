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
    return view('welcome');
});
Route::group(['namespace'=>'Backend','as'=>'backend.'], function() {
    Route::resource('/users', 'UserController');
});



Route::group (['prefix' => '/posts'],function (){
    Route::get('/','PostController@index')->name('posts.index');
    Route::get('/create','PostController@create')->name('posts.create');
    Route::post('/submit','PostController@store')->name('posts.store');
    Route::get('/show/{id}','PostController@show')->name('posts.show');
    Route::get('/edit/{id}','PostController@edit')->name('posts.edit');
    Route::put('/update/{id}','PostController@update')->name('posts.update');
    Route::get('/delete/{id}','PostController@destroy')->name('posts.delete');
    Route::get('/undo-delete/{id}','PostController@undoDelete')->name('posts.undoDelete');
    Route::get('/trash-posts','PostController@trashPost')->name('posts.trash');
    Route::get ('/permanent-delete-posts/{id}','PostController@permanentDelete')->name('posts.permaDelete');
});



