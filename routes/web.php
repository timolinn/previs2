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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function() {
    Route::get('/{userId}/order-ready-notif/{orderId}', 'AdminController@sendOrderReadyNotif');
});

Route::get('/dashboard', 'DashboardController@index');

Route::get('/users', 'UserController@index');
Route::get('/', 'HomeController@index');

Route::group(['prefix' => 'auth'], function() {
    Route::get('/login', 'AuthController@getLoginForm');
    Route::post('/logout', 'AuthController@logout');
    Route::post('/login', 'AuthController@postLogin');
    Route::get('/register', 'AuthController@getRegisterForm');
    Route::post('/register', 'AuthController@postRegister');
});

Route::group(['prefix' => 'items'], function() {
    Route::get('/', 'ItemController@getAllItems');
    Route::get('/create', 'ItemController@getCreate');
    Route::get('/{id}/edit', 'ItemController@getEdit');
    Route::get('/{id}', 'ItemController@getItem');
    Route::post('/create', 'ItemController@createNewItem');
    Route::post('/update', 'ItemController@updateItem');
    Route::post('/delete', 'ItemController@deleteItem');
});

Route::group(['prefix' => 'orders'], function() {
    Route::get('/', 'OrderController@getAllOrders');
    Route::get('/create', 'OrderController@getCreate');
    Route::get('/edit', 'OrderController@getEdit');
    Route::get('/{id}', 'OrderController@getOrder');
    Route::post('/create', 'OrderController@createNewOrder');
    Route::post('/update', 'OrderController@updateOrder');
    Route::get('/{id}/delivered', 'OrderController@deliver');
    Route::post('/delete', 'OrderController@deleteOrder');
});

Route::group(['prefix' => 'carts'], function() {
    Route::get('/', 'CartController@getAllOrders');
    Route::get('/{item}/{quantity}/create', 'CartController@create');
    Route::get('/edit', 'CartController@getEdit');
    Route::get('/checkout', 'CartController@checkout');
    Route::get('/{id}', 'CartController@getOrder');
    Route::post('/create', 'CartController@createNewOrder');
    Route::post('/update', 'CartController@updateOrder');
    Route::post('/delete', 'CartController@deleteOrder');
});

Route::get('/send', 'AdminController@send');
