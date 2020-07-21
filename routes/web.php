<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', 'UserController', ['except' => ['show']]);
    Route::get('user/{id}', ['as' => 'user.edit', 'uses' => 'UserController@edit']);
    Route::get('allAdmin', ['as' => 'user.admin.index', 'uses' => 'UserController@indexAdmin']);
    Route::get('allUser', ['as' => 'user.user.index', 'uses' => 'UserController@indexUser']);
    Route::post('user/{id}', ['as' => 'user.updateRole', 'uses' => 'UserController@updateRole']);


	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);

    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
    Route::post('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

    Route::post('profile', ['as' => 'profile.upload', 'uses' => 'ProfileController@upload']);
});

