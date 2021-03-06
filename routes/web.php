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

Route::get('/', 'Frontend\HomeController@home')->name('home');
Route::get('/FAQ', 'Frontend\FAQController@faq')->name('faq');
Route::get('/product/{product}', 'Frontend\ProductController@product')->name('product');
Route::get('/category/{category}', 'Frontend\CategoryController@category')->name('category');
Route::post('/category/{category}/productsFilter/page/{page}', 'Frontend\CategoryController@paginateElementWithFilter')->name('category.products.paginate.filter');

Route::post('/search', 'Frontend\SearchController@search')->name('search');
Route::get('/search/{search}', 'Frontend\SearchController@searchProducts')->name('search.products');
Route::post('/search/{search}/api/page/{page}', 'Frontend\SearchController@apiSearch')->name('search.api');

Route::get('/cart', 'Frontend\CartController@cart')->name('cart');

Route::post('/order', 'Frontend\OrderController@order')->name('cart.order');

Route::get('/payment/{order}', 'Frontend\PaymentController@showPaymentPage')->name('payment');
Route::post('/order/payment', 'Frontend\PaymentController@payment')->name('cart.payment');

Route::get('/profile', 'Frontend\UserController@profile')->name('profile');

Route::put('/profile', 'Frontend\UserController@updateProfile')->name('profile.update');
Route::put('/profile/password', 'Frontend\UserController@password')->name('profile.password');
Route::post('/profile/password', 'Frontend\UserController@password')->name('profile.password');



Route::get('/profile/orders', 'Frontend\UserController@orders')->name('user.orders');
Route::get('/profile/histories', 'Frontend\UserController@histories')->name('user.histories');
Route::get('/profile/comments', 'Frontend\UserController@comments')->name('user.comments');


Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', 'Frontend\AuthController@showLoginForm')->name('login.user');
    Route::get('/register', 'Frontend\AuthController@showRegisterForm')->name('register.user');
});

Route::get('/products/{product}/comments', 'Frontend\CommentController@index')->name('comments.product.index');
Route::get('/comments/{comment}/replies', 'Frontend\CommentController@show')->name('replies.comment.show');

Route::group(['middleware' => ['auth']], function () {
    Route::post('/comments/{product}','Frontend\CommentController@store')->name('comment.product.store');
    Route::post('/votes/{entity}','Frontend\VoteController@vote')->name('vote.entity');
    Route::post('/profile/avatar', ['as' => 'user.avatar', 'uses' => 'Frontend\UserController@uploadAvatar']);
});

////////////////////////////////////////////////////////////////////////////////////////
//Backend
Route::group(['prefix'=>'management'], function () {
    Route::get('', 'Backend\HomeController@welcome')->middleware('management.auth')->name('management');
    // Route::get('/management', 'Backend\HomeController@index')->middleware('isAdmin')->name('management');
    Auth::routes();
});

Route::group(['prefix'=>'management','middleware' => 'admin'], function () {

    Route::get('/home', 'Backend\HomeController@index')->name('home');

    Route::resource('user', 'Backend\UserController', ['except' => ['show']]);

    Route::get('allAdmin', ['as' => 'user.admin.index', 'uses' => 'Backend\UserController@indexAdmin']);
    Route::get('allUser', ['as' => 'user.user.index', 'uses' => 'Backend\UserController@indexUser']);
    Route::get('profile', ['as' => 'user.profile', 'uses' => 'Backend\UserController@profile']);
    Route::put('profile', ['as' => 'user.update.profile', 'uses' => 'Backend\UserController@updateProfile']);
    Route::post('profile', ['as' => 'user.upload.avatar', 'uses' => 'Backend\UserController@uploadAvatar']);
    Route::put('profile/password', ['as' => 'user.password', 'uses' => 'Backend\UserController@password']);
    Route::post('profile/password', ['as' => 'user.password', 'uses' => 'Backend\UserController@password']);

    Route::resource('role', 'Backend\RoleController', ['except' => ['edit','update','show','destroy'] ] );

    Route::resource('brand', 'Backend\BrandController', ['except' => ['show'] ] );

    Route::resource('image', 'Backend\ImageController', ['except' => ['update','edit'] ] );
    Route::post('/images-upload', ['as' => 'image.upload', 'uses' => 'Backend\ImageController@upload']);

    Route::resource('category', 'Backend\CategoryController',['except' => ['show'] ]);
    Route::post('allCategory', ['as' => 'category.indexJson', 'uses' => 'Backend\CategoryController@indexJson']);
    Route::get('Category/Level/{level}', ['as' => 'category.indexLevel', 'uses' => 'Backend\CategoryController@indexByLevel']);

    Route::resource('product', 'Backend\ProductController');

    Route::resource('order', 'Backend\OrderController', ['except' => ['create','store','edit','destroy'] ]);
    Route::post('orders/{order}/products', ['as' => 'order.productRelat', 'uses' => 'Backend\OrderController@getProductRelat']);


    Route::get('comments/{comment}',  ['as' => 'comment.show', 'uses' => 'Backend\CommentController@show'] );
    Route::delete('comments/{comment}',  ['as' => 'comment.destroy', 'uses' => 'Backend\CommentController@destroy'] );

    Route::post('supplies', ['as' => 'supply.store', 'uses' => 'Backend\SupplyController@store']);
    Route::get('supplies/create/{product}',  ['as' => 'supply.create', 'uses' => 'Backend\SupplyController@create'] );
    Route::get('supplies/{supply}',  ['as' => 'supply.show', 'uses' => 'Backend\SupplyController@show'] );
    Route::put('supplies/{supply}',  ['as' => 'supply.update', 'uses' => 'Backend\SupplyController@update'] );
    Route::delete('supplies/{supply}',  ['as' => 'supply.destroy', 'uses' => 'Backend\SupplyController@destroy'] );


    Route::get('histories/{history}',  ['as' => 'history.show', 'uses' => 'Backend\HistoryController@show'] );

    Route::get('deliveries/create/{order}',  ['as' => 'delivery.create', 'uses' => 'Backend\DeliveryController@create'] );
    Route::post('deliveries', ['as' => 'delivery.store', 'uses' => 'Backend\DeliveryController@store']);

    Route::resource('payment', 'Backend\PaymentController',['except' => ['edit','update','show'] ]);

    Route::get('invoice',  ['as' => 'invoice.index', 'uses' => 'Backend\InvoiceController@index'] );
    Route::get('invoice/{invoice}',  ['as' => 'invoice.show', 'uses' => 'Backend\InvoiceController@show'] );
});
