<?php

/*
|--------------------------------------------------------------------------
| POS Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Route;

Route::namespace('Backend')->group(function(){
    Route::get('/pos/products', 'PosController@search')->name('pos.search_product');
    Route::get('pos/create','PosController@create')->name('pos.create');
    Route::post('pos/store','PosController@store')->name('pos.store');
    Route::get('/variants', 'PosController@getVarinats')->name('variants');
    Route::post('/add-to-cart-pos', 'PosController@addToCart')->name('pos.addToCart');
    Route::post('/update-quantity-cart-pos', 'PosController@updateQuantity')->name('pos.updateQuantity');
    Route::post('/remove-from-cart-pos', 'PosController@removeFromCart')->name('pos.removeFromCart');
    Route::post('/get_shipping_address', 'PosController@getShippingAddress')->name('pos.getShippingAddress');
    Route::post('/setDiscount', 'PosController@setDiscount')->name('pos.setDiscount');
    Route::post('/setShipping', 'PosController@setShipping')->name('pos.setShipping');
    Route::post('/pos-order', 'PosController@order_store')->name('pos.order_place');

});

//Admin
Route::group(['prefix' =>'admin', 'middleware' => 'role:vendor','namespace'=>'Backend'], function(){
	//pos
    Route::get('/pos', 'PosController@index')->name('poin-of-sales.index');
    Route::get('pos/delete/{id}','PosController@delete')->name('pos.delete');
	Route::get('/pos-activation', 'PosController@pos_activation')->name('poin-of-sales.activation');
});
Route::group(['prefix' =>'seller', 'middleware' => ['seller', 'verified']], function(){
    //pos
    Route::get('/pos', 'PosController@index')->name('poin-of-sales.seller_index');

});
