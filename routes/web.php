
<?php
use Illuminate\Support\Facades\Route;
Route::get('/','WelcomeController@index')->name('welcome');
Route::get('/homepage/data','WelcomeController@homepageData')->name('homepage.data');
Route::get('/all/product','WelcomeController@allProduct')->name('all.product');
Route::get('/product/detail/{slug}','ProductController@product_detail')->name('product.detail');
Route::get('/customer/wishlist/count','ProductController@wishlistCount');
Route::get('/flash/product','ProductController@flashSell')->name('flash.product');
Route::get('/all/flash/product/{id}','ProductController@flasProduct')->name('all.flash.product');
Route::get('/category/{slug}','CategoryController@index')->name('category.product');
Route::get('/subcategory/{slug}','CategoryController@subcategory')->name('subcategory.product');
Route::get('/category/product/{slug}','CategoryController@categoryProduct');
Route::get('/subcategory/product/{slug}','CategoryController@subCategoryProduct');
Route::get('/review/{id}','ProductController@productReviews');
Route::get('/seller/{id}','UserController@seller')->name('vendor.detail');
Route::get('/seller/product/{id}','UserController@sellerProduct');
Route::get('/stores', 'WelcomeController@stores')->name('store');
Route::get('/search', 'SearchController@index')->name('search');
Route::get('/search/result', 'SearchController@result')->name('search.result');
Route::post('/add_to_wishlist/{id}','ProductController@add_to_wishlist')->name('product.addToWishlist');
Route::get('/customer/login','UserController@login')->name('customer.login');
Route::post('/customer/login','UserController@authenticate')->name('customer.authenticate');
Route::get('/customer/register','UserController@signup')->name('customer.signup');
Route::post('/addnew/customer','UserController@register')->name('customer.add');

//all category with subcategory api
Route::get('get/all/category','CategoryController@getAllCategory');

//caret controller 




//authenticated user middleware
Route::group(['middleware'=>['auth']], function(){
    Route::post('/change/password','UserController@changePassword')->name('change.password');
    Route::post('/add/review/{id}','ProductController@addReview')->name('add.review');
});

Route::get('/register','Seller\SellerController@sellerSignUp')->name('seller.signup');
//vendor login and registration
Route::group(['namespace'=>'Seller','as'=>'seller.','prefix'=>'seller'], function(){
    //Route::get('/register','SellerController@sellerSignUp')->name('signup');
    Route::get('/login','SellerController@sellerLogin')->name('login');
    Route::post('/register','SellerController@sellerRegister')->name('add');
});



//customer after login access dashboard entities
Route::group(['as'=>'customer.','prefix'=>'customer','middleware'=>['auth'], 'namespace'=>'Customer'], function(){
    Route::get('/dashboard','DashboardController@index')->name('dashboard');
    Route::get('/profile','DashboardController@profile')->name('profile');
    Route::get('/address','DashboardController@address')->name('address');
    Route::get('/order','DashboardController@order')->name('order');
    Route::get('/wishlist','DashboardController@wishlist')->name('wishlist');
    Route::get('/review','DashboardController@review')->name('review');
    Route::get('/change/password','DashboardController@changePassword')->name('change.password');
    Route::get('/cart','DashboardController@cart')->name('cart');
    Route::get('/checkout','CheckoutController@index')->name('checkout');
    Route::post('/place/order','CheckoutController@processOrder')->name('place.order');
    
    Route::get('/coupon','CheckoutController@applyCoupon')->name('coupon');
    Route::get('/track/order','DashboardController@trackOrder')->name('order.track');
    Route::put('/profile/update','CustomerController@updateCustomerProfile')->name('update.profile');
    Route::post('/add/address','CustomerController@addCustomerAddress')->name('add.address');
    Route::put('/address/update','CustomerController@UpdateCustomerAddress')->name('add.address');
    Route::get('/cart/product','CartController@index')->name('cart.product');
    Route::post('/addToCart','CartController@add')->name('customer.addToCart');
    Route::delete('/deleteCart/{id}','CartController@destroy');
    Route::delete('/delete/all/cart','CartController@deleteAll');
    Route::post('/update/cart','CartController@changeQuantity');
});
