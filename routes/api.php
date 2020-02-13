<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware(['auth:api', 'cors'])->get('/user', function (Request $request) {
	return $request->user();
});

/*     Product API'S     */

Route::post('/addProduct', 'ProductApiController@addProduct');

Route::get('/products', 'ProductApiController@homePage')->middleware('cors');

Route::get('/product-details/{id}', 'ProductApiController@showProductById')->middleware('cors');

Route::get('/search/{query}', 'ProductApiController@searchProducts')->middleware('cors');

Route::get('/suggest/{query}', 'ProductApiController@suggestProducts')->middleware('cors');

/*   USER Authentication API's   */

Route::post('/register', 'UserController@register')->middleware('cors');

Route::post('/login', 'UserController@login')->middleware('cors');

Route::post('/show', 'UserController@showData')->middleware('cors');

Route::group(['middleware' => 'auth:api'], function () {
	Route::post('/users', 'UserController@details')->middleware('cors');
});

Route::group(['middleware' => 'auth:api'], function () {
	Route::post('/add-to-cart', 'CartController@addToCart')->middleware('cors');
});

Route::group(['middleware' => 'auth:api'], function () {
	Route::get('/cart-details', 'CartController@getCartDetailsByUserId')->middleware('cors');
});

Route::group(['middleware' => 'auth:api'], function () {
	Route::post('/cart-delete', 'CartController@deleteCartItem')->middleware('cors');
});

Route::group(['middleware' => 'auth:api'], function () {
	Route::post('/cart-update', 'CartController@updateCartItem')->middleware('cors');
});
Route::get('/total-amount', 'CartController@getTotalAmount')->middleware('cors');

Route::get('/testing', 'CartController@testing')->middleware('cors');

Route::group(['middleware' => 'auth:api'], function () {
	Route::post('/place-order', 'OrderController@placeOrder')->middleware('cors');
});
