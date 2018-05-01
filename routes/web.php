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

Route::get('/mailable', function () {
    $user = Previs\Models\User::find(2);
    $order = Previs\Models\Order::find(1);


    return new Previs\Mail\OrderDetails($user, $order);
});

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['prefix' => 'admin'], function() {
    Route::get('/{userId}/order-ready-notif/{orderId}', 'AdminController@sendOrderReadyNotif');
    Route::get('/users', 'UserController@index');
});

Route::get('/dashboard', 'DashboardController@index');

Route::group(['prefix' => 'account'], function () {
    Route::get('/{username}', 'UserController@show')->name('account');
});
Route::get('/', 'HomeController@index')->name('home');

// Route::group(['prefix' => 'auth'], function() {
//     Route::get('/login', 'AuthController@getLoginForm');
//     Route::post('/logout', 'AuthController@logout');
//     Route::post('/login', 'AuthController@postLogin');
//     Route::get('/register', 'AuthController@getRegisterForm');
//     Route::post('/register', 'AuthController@postRegister');
// });

Route::group(['prefix' => 'items'], function() {
    Route::get('/', 'ItemController@getAllItems');
    Route::get('/create', 'ItemController@getCreate');
    Route::get('/{id}/edit', 'ItemController@getEdit');
    Route::get('/{id}', 'ItemController@getItem')->name('show-item');
    Route::post('/create', 'ItemController@createNewItem');
    Route::post('/update', 'ItemController@updateItem');
    Route::post('/delete', 'ItemController@deleteItem');
});

Route::group(['prefix' => 'orders'], function() {
    Route::get('/', 'OrderController@getAllOrders');
    Route::get('/create', 'OrderController@getCreate');
    Route::get('/edit', 'OrderController@getEdit');
    Route::get('/review-order', 'OrderController@reviewOrder')->name('review-order');
    Route::get('/{id}', 'OrderController@getOrder');
    Route::post('/create', 'OrderController@createNewOrder')->name('create-order');
    Route::post('/update', 'OrderController@updateOrder');
    Route::get('/{id}/delivered', 'OrderController@deliver');
    Route::post('/delete', 'OrderController@deleteOrder');
});

Route::group(['prefix' => 'cart'], function() {
    Route::get('/', 'CartController@getCart')->name('cart');
    Route::get('/{item}/{quantity}/create', 'CartController@create');
    Route::get('/edit', 'CartController@getEdit');
    Route::get('/checkout', 'CartController@checkout')->name('checkout');
    Route::get('/total-amount', 'CartController@getTotalAmount');
    Route::get('/contents', 'CartController@getCartContents')->name('get-cart');
    // Route::post('/create', 'CartController@createNewOrder')->name('create-order');
    Route::post('/update', 'CartController@updateOrder');
    Route::get('/delete/{rowId}', 'CartController@deleteItem')->name('delete-item');
});

Route::get('/send', 'AdminController@send');

Auth::routes();

Route::get('/addtocart', 'CartController@addToCart')->name('add-to-cart');
