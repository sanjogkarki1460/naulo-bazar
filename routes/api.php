	<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Api')->prefix('v1')->middleware('cors')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('login', 'AuthController@login');
        Route::post('signup', 'AuthController@signup');
        Route::post('social-login', 'AuthController@socialLogin');
        Route::post('reset-password', 'PasswordResetController@create');
        Route::middleware('auth:api')->group(function () {
            Route::get('logout', 'AuthController@logout');
            Route::get('user', 'AuthController@user');
            Route::post('change-password','AuthController@changePassword');
        });
    });
  Route::post('forget-password','PasswordResetController@forgetPassword');
    Route::apiResource('banners', 'BannerController')->only('index');
    Route::get('brands/top', 'BrandController@top');
    Route::apiResource('brands', 'BrandController')->only('index');
	Route::get('pages','PageController@index');
	Route::get('page/{slug}','PageController@details');
    Route::apiResource('business-settings', 'BusinessSettingController')->only('index');

    Route::get('categories/featured', 'CategoryController@featured');
    Route::get('categories/home', 'CategoryController@home');
	Route::get('categories/top', 'CategoryController@top')->name('category.top');

    Route::apiResource('categories', 'CategoryController')->only('index');
	Route::get('categories/{slug}','CategoryController@subCategory');
    Route::get('sub-categories/{id}', 'SubCategoryController@index')->name('subCategories.index');

    Route::apiResource('colors', 'ColorController')->only('index');

    Route::apiResource('currencies', 'CurrencyController')->only('index');

    Route::apiResource('customers', 'CustomerController')->only('show');

    Route::apiResource('general-settings', 'GeneralSettingController')->only('index');

    Route::apiResource('home-categories', 'HomeCategoryController')->only('index');

    Route::get('purchase-history/{id}', 'PurchaseHistoryController@index')->middleware('auth:api');
    Route::get('purchase-history-details/{id}', 'PurchaseHistoryDetailController@index')->name('purchaseHistory.details')->middleware('auth:api');

    Route::get('products/admin', 'ProductController@admin');
    Route::get('products/seller', 'ProductController@seller');
    Route::get('products/category/{id}', 'ProductController@category')->name('api.products.category');
    Route::get('products/sub-category/{id}', 'ProductController@subCategory')->name('products.subCategory');
    Route::get('products/sub-sub-category/{id}', 'ProductController@subSubCategory')->name('products.subSubCategory');
    Route::get('products/brand/{id}', 'ProductController@brand')->name('api.products.brand');
    Route::get('products/todays-deal', 'ProductController@todaysDeal');
    Route::get('products/flash-deal', 'ProductController@flashDeal');
    Route::get('products/featured', 'ProductController@featured');
    Route::get('products/best-seller', 'ProductController@bestSeller');
    Route::get('products/related/{id}', 'ProductController@related')->name('products.related');
    Route::get('products/top-from-seller/{id}', 'ProductController@topFromSeller')->name('products.topFromSeller');
    Route::get('search', 'SearchController@search');
    Route::post('products/variant/price', 'ProductController@variantPrice');
    Route::get('products/home', 'ProductController@home');
    Route::apiResource('products', 'ProductController')->except(['store', 'update', 'destroy']);

    Route::get('carts', 'CartController@index')->middleware('auth:api');
    Route::post('carts/add', 'CartController@add')->middleware('auth:api');
    Route::get('carts/{id}', 'CartController@show')->middleware('auth:api');
    Route::post('carts/change-quantity', 'CartController@changeQuantity')->middleware('auth:api');
    Route::delete('carts/{id}', 'CartController@destroy')->middleware('auth:api');

    Route::get('reviews/product/{slug}', 'ReviewController@index')->name('api.reviews.index');

    Route::get('shop/user/{id}', 'ShopController@shopOfUser')->middleware('auth:api');
    Route::get('shops/details/{id}', 'ShopController@info')->name('shops.info');
    Route::get('follow-shop/{id}','ShopController@follow')->name('shops.follow')->middleware('auth:api');
    Route::get('just-for-you','ShopController@justForYou')->name('shops.just')->middleware('auth:api');
    Route::get('shops/products/all/{id}', 'ShopController@allProducts')->name('shops.allProducts');
    Route::get('shops/products/top/{id}', 'ShopController@topSellingProducts')->name('shops.topSellingProducts');
    Route::get('shops/products/featured/{id}', 'ShopController@featuredProducts')->name('shops.featuredProducts');
    Route::get('shops/products/new/{id}', 'ShopController@newProducts')->name('shops.newProducts');
    Route::get('shops/brands/{id}', 'ShopController@brands')->name('shops.brands');
    Route::apiResource('shops', 'ShopController')->only('index');
    Route::get('/track_your_order', 'ProductController@trackOrder')->name('orders.track');

    Route::apiResource('sliders', 'SliderController')->only('index');

    Route::get('reward-point-check','AddOnController@rewardPoint');

    Route::get('wishlists/{id}', 'WishlistController@index')->middleware('auth:api');
    Route::post('wishlists/check-product', 'WishlistController@isProductInWishlist')->middleware('auth:api');
    Route::apiResource('wishlists', 'WishlistController')->except(['index', 'update', 'show'])->middleware('auth:api');

    Route::apiResource('settings', 'SettingsController')->only('index');

    Route::get('policies/seller', 'PolicyController@sellerPolicy')->name('policies.seller');
    Route::get('policies/support', 'PolicyController@supportPolicy')->name('policies.support');
    Route::get('policies/return', 'PolicyController@returnPolicy')->name('policies.return');

    Route::get('user/info/{id}', 'UserController@info')->middleware('auth:api');
    Route::post('user/info/update', 'UserController@updateName')->middleware('auth:api');
    Route::post('user/shipping/update', 'UserController@updateShippingAddress')->middleware('auth:api');

    Route::post('coupon/apply', 'CouponController@apply')->middleware('auth:api');
    Route::post('payments/pay/stripe', 'StripeController@processPayment')->middleware('auth:api');
    Route::post('payments/pay/paypal', 'PaypalController@processPayment')->middleware('auth:api');
    Route::post('payments/pay/cod', 'PaymentController@cashOnDelivery')->middleware('auth:api');

    Route::post('order/store', 'OrderController@store')->middleware('auth:api');

	Route::post('guest-checkout','OrderController@guestCheckout')->middleware('api');
	 Route::get('/affiliate', 'AffiliateController@index')->name('affiliate.apply');
    Route::post('/affiliate/store', 'AffiliateController@store_affiliate_user')->name('affiliate.store_affiliate_user')->middleware('api');
    Route::get('/affiliate/user', 'AffiliateController@user_index')->name('affiliate.user.index');

    Route::get('/affiliate/payment/settings', 'AffiliateController@payment_settings')->name('affiliate.payment_settings');
    Route::post('/affiliate/payment/settings/store', 'AffiliateController@payment_settings_store')->name('affiliate.payment_settings_store');

	Route::resource('addresses', 'AddressController')->middleware('auth:api');
   Route::get('/addresses/destroy/{id}', 'AddressController@destroy')->middleware('auth:api');
Route::get('/addresses/set_default/{id}', 'AddressController@set_default')->middleware('auth:api');


        Route::get('/compare', 'CompareController@index')->name('compare');
        Route::get('/compare/reset', 'CompareController@reset')->name('compare.reset');
        Route::post('/compare/addToCompare', 'CompareController@addToCompare')->name('compare.addToCompare');


Route::get('customer_package','PackageController@index');
});

Route::fallback(function () {
    return response()->json([
        'data' => [],
        'success' => false,
        'status' => 404,
        'message' => 'Invalid Route'
    ]);
});

