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
	
Route::resource('userInfo','UserInfoController');

Route::get('/', function () {
    return view('welcome');
});

Route::post('fileUpload', ['as'=>'fileUpload','uses'=>'UserInfoController@store']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('userCredentials','UserCredentialsController');
