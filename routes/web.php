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

    Route::get('profile', ['as' => 'user.profile', 'uses' => 'UserController@profile']);
    Route::put('profile', ['as' => 'user.update.profile', 'uses' => 'UserController@updateProfile']);
    Route::post('profile', ['as' => 'user.upload.avatar', 'uses' => 'UserController@uploadAvatar']);

    Route::put('profile/password', ['as' => 'user.password', 'uses' => 'UserController@password']);
    Route::post('profile/password', ['as' => 'user.password', 'uses' => 'UserController@password']);

    Route::resource('category', 'CategoryController');
    Route::post('allCategory', ['as' => 'category.indexJson', 'uses' => 'CategoryController@indexJson']);
    Route::get('Category/Level/{level}', ['as' => 'category.indexLevel', 'uses' => 'CategoryController@indexByLevel']);

    Route::resource('image', 'ImageController', ['except' => ['update','edit'] ] );
    Route::post('/images-upload', ['as' => 'image.upload', 'uses' => 'ImageController@upload']);

    // Route::resource('image', 'ImageController', ['except' => ['show','update','edit','create','store'] ] );
    // Route::get('image', ['as' => 'image.index', 'uses' => 'ImageController@index']);

    Route::resource('brand', 'BrandController', ['except' => ['show'] ] );

    Route::resource('product', 'ProductController');

    Route::resource('order', 'OrderController', ['except' => ['create','store','show','edit','destroy'] ]);

    // Route::resource('comment', 'CommentController', ['except' => ['index','create','store','update','edit'] ]);
    Route::get('comments/{comment}',  ['as' => 'comment.show', 'uses' => 'CommentController@show'] );
    Route::delete('comments/{comment}',  ['as' => 'comment.destroy', 'uses' => 'CommentController@destroy'] );



    // Route::get('category', ['as' => 'category.index', 'uses' => 'CategoryController@index']);
    // Route::get('category/create', ['as' => 'category.create', 'uses' => 'CategoryController@create']);
    // Route::get('category/{id}/edit', ['as' => 'category.edit', 'uses' => 'CategoryController@edit']);

    // Route::post('category', ['as' => 'category.store', 'uses' => 'CategoryController@store']);
});

