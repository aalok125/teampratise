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
    Route::get('/{post}/edit','PostController@edit')->name('posts.edit');
    Route::put('/update/{post}','PostController @update')->name('posts.update');
    Route::delete('/delete','PostController@destroy')->name('posts.delete');
});



