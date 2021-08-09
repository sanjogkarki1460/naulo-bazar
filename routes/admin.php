<?php

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
Route::get('/login', 'Backend\Auth\AuthController@login')->name('admin-login');
// Route::get('/', function () {
//     return view('welcome');
// });
Route::namespace('Backend\Auth')->prefix('auth')->group(function () {
    Route::post('/login', 'AuthController@loginAction');
    Route::get('/registerPage', 'AuthController@register');
    Route::post('/register', 'AuthController@registerAction');
    Route::get('/logout', 'AuthController@logout')->name('logout');
});

Route::group(['middleware' => 'role:admin|vendor', 'namespace' => 'Backend'], function () {
    /*------------------------------Dashboard Controller ------------------------------------*/


    Route::prefix('dashboard')->group(function () {

        Route::get('/', 'MainController@dashboard')->name('admin-dashboard');
        Route::get('/googleanalytics', 'MainController@bodyContent')->name('admin-googleanalytics');
        Route::get('/admin-vendor', ['middleware' => ['role:admin'], 'uses' => 'DashboardController@vendorReport'])->name('vendor-report');
        Route::get('/admin-customer', ['middleware' => ['permission:customer-report'], 'uses' => 'DashboardController@customerReport'])->name('customer-report');
        Route::get('/admin-product', ['middleware' => ['permission:product-report'], 'uses' => 'DashboardController@productReport'])->name('product-report');
        Route::get('/vendordashboard', ['middleware' => ['permission:vendor-dashboard'], 'uses' => 'MainController@vendorDashboard'])->name('vendor-dashboard');
        Route::post('/withdraw', ['middleware' => ['permission:withdraw-money'], 'uses' => 'MainController@requestWithdraw'])->name('withdraw-money');
        Route::get('/withdraw/cancel/{id}', ['middleware' => ['permission:cancel-withdraw-money'], 'uses' => 'MainController@cancelWithDraw'])->name('cancel-withdraw-money');

    });

    // Page Controller

    Route::get('/&{slug}', 'PagesController@single');
    Route::name('pages.')->prefix('pages')->group(function () {
        Route::get('/', 'PagesController@index')->name('list');
        Route::post('/create', 'PagesController@create')->name('create');
        Route::get('/edit/{id}', 'PagesController@edit');
        Route::post('/update', 'PagesController@update')->name('update');
        Route::get('/delete/{id}', 'PagesController@delete')->name('delete');
        Route::post('/set_order', 'PagesController@set_order')->name('order_pages');
    });

    /*------------------------------Product Controller ------------------------------------*/

    Route::prefix('/product')->name('products.')->group(function () {
        Route::get('/admin', 'ProductController@admin_products')->name('admin');
        Route::get('/seller', 'ProductController@seller_products')->name('seller');
        Route::get('/create', 'ProductController@create')->name('create');
        Route::get('/admin/{id}/edit', 'ProductController@admin_product_edit')->name('admin.edit');
        Route::get('/seller/{id}/edit', 'ProductController@seller_product_edit')->name('seller.edit');
        Route::post('/todays_deal', 'ProductController@updateTodaysDeal')->name('todays_deal');
        Route::post('/get_products_by_subsubcategory', 'ProductController@get_products_by_subsubcategory')->name('get_products_by_subsubcategory');
        Route::get('/comments', 'ProductController@comments')->name('comments');
        Route::post('/store', 'ProductController@store')->name('store');
        Route::post('/subcategories/get_subcategories_by_category', 'CategoryController@get_subcategories_by_category')->name('subcategories.get_subcategories_by_category');
        Route::post('/products/update/{id}', 'ProductController@update')->name('update');

        // Route::get('getvariationwithcolor', 'FrontEndController@getvariationwithcolor')->name('getvariationwithcolor');
        Route::post('sku_combination', 'ProductController@sku_combination')->name('sku_combination');
        Route::post('sku_combination_edit', 'ProductController@sku_combination_edit')->name('sku_combination_edit');
        Route::get('/destroy/{id}', 'ProductController@destroy')->name('destroy');
        Route::get('/duplicate/{id}', 'ProductController@duplicate')->name('duplicate');
        Route::post('/sku_combination', 'ProductController@sku_combination')->name('sku_combination');
        Route::post('/sku_combination_edit', 'ProductController@sku_combination_edit')->name('sku_combination_edit');
        Route::post('/featured', 'ProductController@updateFeatured')->name('featured');
        Route::post('/published', 'ProductController@updatePublished')->name('published');


    });

    /*------------------------------Comment Controller ------------------------------------*/
    Route::prefix('/comments')->name('comments.')->group(function () {
        Route::get('/accept/{id}', 'ProductController@commentAccept')->name('accept');
        Route::get('/decline/{id}', 'ProductController@commentDecline')->name('decline');
        Route::get('/delete/{id}', 'ProductController@commentDelete')->name('delete');
    });


    /*------------------------------Club Point----------------------------------------------*/
    Route::get('club-points/configuration', 'ClubPointController@configure_index')->name('club_points.configs');
    Route::get('club-points/index', 'ClubPointController@index')->name('club_points.index');
    Route::get('set-club-points', 'ClubPointController@set_point')->name('set_product_points');
    Route::post('set-club-points/store', 'ClubPointController@set_products_point')->name('set_products_point.store');
    Route::get('set-club-points/{id}', 'ClubPointController@set_point_edit')->name('product_club_point.edit');
    Route::get('club-point-details/{id}', 'ClubPointController@club_point_detail')->name('club_point.details');
    Route::post('set-club-points/update/{id}', 'ClubPointController@update_product_point')->name('product_point.update');
    Route::post('club-point-convert-rate/store', 'ClubPointController@convert_rate_store')->name('point_convert_rate_store');
    /*------------------------------Category Controller ------------------------------------*/

    Route::resource('categories', 'CategoryController');

    Route::get('/request', 'CategoryController@request')->name('request');
    Route::post('/request', 'CategoryController@requestCategory')->name('requestCategory');
    Route::get('/request/accept/{id}/notification/{notification}', 'CategoryController@requestAccept')->name('request.accept');
    Route::get('/request/decline/{id}/notification/{notification}', 'CategoryController@requestDecline')->name('request.decline');
    Route::get('/markasread', 'CategoryController@markAsRead')->name('markasReadCategory');
    Route::get('/deletenotification', 'CategoryController@deleteNotification')->name('deleteNotification');

    /*------------------------------Market Controller ------------------------------------*/
//
    /*------------------------------Order Controller ------------------------------------*/
    Route::prefix('/order')->name('orders.')->group(
        function () {

            Route::get('/', 'OrderController@admin_orders')->name('admin');
            Route::get('/{id}/show', 'OrderController@show')->name('show');
            Route::get('/sales/{id}/show', 'OrderController@sales_show')->name('.show');
            Route::get('/destroy/{id}', 'OrderController@destroy')->name('destroy');



        }
    );
    Route::resource('shops', 'ShopController');
    Route::resource('orders','OrderController');
	Route::get('/orders/destroy/{id}', 'OrderController@destroy')->name('orders.destroy');
	Route::post('/orders/details', 'OrderController@order_details')->name('orders.details');
	Route::post('/orders/update_delivery_status', 'OrderController@update_delivery_status')->name('orders.update_delivery_status');
	Route::post('/orders/update_payment_status', 'OrderController@update_payment_status')->name('orders.update_payment_status');


	Route::resource('purchase_history','PurchaseHistoryController');
	Route::post('/purchase_history/details', 'PurchaseHistoryController@purchase_history_details')->name('purchase_history.details');
	Route::get('/purchase_history/destroy/{id}', 'PurchaseHistoryController@destroy')->name('purchase_history.destroy');

    Route::prefix('/reviews')->name('reviews.')->group(
        function () {

    Route::get('/', 'ReviewController@index')->name('list');
    Route::get('/json', 'ReviewController@getReviewJson')->name('json');
    Route::post('/status/{id}', 'ReviewController@updateStatus')->name('status');

    Route::get('/review/delete/{id}', 'ReviewController@destroy')->name('delete');

}
);


Route::group(['prefix' =>'admin', 'middleware' => ['auth', 'admin']], function(){
    Route::get('/refund-request-all', 'RefundRequestController@admin_index')->name('refund_requests_all');
    Route::get('/refund-request-config', 'RefundRequestController@refund_config')->name('refund_time_config');
    Route::get('/paid-refund', 'RefundRequestController@paid_index')->name('paid_refund');
    Route::post('/refund-request-pay', 'RefundRequestController@refund_pay')->name('refund_request_money_by_admin');
    Route::post('/refund-request-time-store', 'RefundRequestController@refund_time_update')->name('refund_request_time_config');
    Route::post('/refund-request-sticker-store', 'RefundRequestController@refund_sticker_update')->name('refund_sticker_config');
});


    /*------------------------------Dispute Controller ------------------------------------*/
    Route::prefix('/dispute')->name('dispute.')->group(
        function () {
            Route::get('/cancelled', 'DisputeController@orderCancelled')->name('cancelled');
            Route::get('/refundrequest', 'DisputeController@refundRequest')->name('refund');
        }
    );

    /*------------------------------Coupon Controller--------------------------------------*/
    Route::prefix('coupons')->name('coupons.')->group(
        function () {
            Route::post('/coupon/get_form', 'CouponController@get_coupon_form')->name('get_coupon_form');
            Route::get('/', 'CouponController@index')->name('list');
            Route::get('/create', 'CouponController@create')->name('create');
            Route::post('/store', 'CouponController@store')->name('store');
            Route::get('/edit/{id}', 'CouponController@get_coupon_form_edit')->name('edit');
            Route::post('/update', 'CouponController@update')->name('update');
            Route::get('/delete/{id}', 'CouponController@delete')->name('delete');


        }
    );

    /*------------------------------Site Controller--------------------------------------*/
    Route::prefix('setting')->middleware('role:admin')->name('sites.')->group(
        function () {
            Route::get('/', 'SiteController@index')->name('index');
            Route::post('/update', 'SiteController@update')->name('update');

        }
    );

    /*------------------------------Product Setting Controller--------------------------------------*/
    Route::prefix('productsetting')->middleware('role:admin')->name('product.setting.')->group(
        function () {
            Route::get('/', 'ProductSettingController@index')->name('index');
            Route::post('store', 'ProductSettingController@store')->name('store');
            Route::get('edit/{id}', 'ProductSettingController@edit')->name('edit');
            Route::put('update/{id}', 'ProductSettingController@update')->name('update');

        }
    );
    /*------------------------------Banner Controller--------------------------------------*/
    Route::prefix('banners')->middleware('role:admin')->name('banners.')->group(
        function () {
            Route::get('/', 'BannerController@index')->name('index');
            Route::post('/store', 'BannerController@store')->name('store');
            Route::get('/edit/{id}', 'BannerController@edit')->name('edit');
            Route::post('/update', 'BannerController@update')->name('update');
            Route::get('/destroy/{id}', 'BannerController@destroy')->name('destroy');

        });
    /*------------------------------User Controller--------------------------------------*/
    Route::prefix('user')->middleware('role:admin')->name('users.')->group(
        function () {
            Route::get('/updateprofile', 'UserController@userProfile')->name('profile');
            Route::get('/edit/{id}', 'UserController@edit')->name('edit');
            Route::put('/update/{id}', 'UserController@updateUser')->name('update');
            Route::get('/list', 'UserController@userList')->name('list');
            Route::get('/vendor/list', 'UserController@vendorList')->name('vendor.list');
            Route::get('/customer/list', 'UserController@customerList')->name('customer.list');
            Route::get('/admin/list', 'UserController@adminList')->name('admin.list');
            Route::post('/create', 'UserController@userAdd')->name('store');
            Route::get('/delete/{id}', 'UserController@Deleteuser')->name('delete');

        });
    /*------------------------------Report Controller--------------------------------------*/
    Route::prefix('report')->middleware('role:admin')->name('reports.')->group(
        function () {
            Route::get('stock', 'ReportController@stock_report')->name('stock');
            Route::get('wishlist', 'ReportController@wishlistReport')->name('wishlist');
            Route::get('commission', 'ReportController@commissionReport')->name('commission');
            Route::get('sellerbased', 'ReportController@sellerBasedReport')->name('seller.based');
            Route::get('seller', 'ReportController@sellerReport')->name('seller');
            Route::get('/in_house_sale_report', 'ReportController@in_house_sale_report')->name('in_house_sale_report');
        });

    /*...............................Notification Controller..............................*/
    Route::prefix('notification')->name('notification.')->group(
        function () {

            Route::get('/', 'NotificationController@index')->name('list');
            Route::get('/delete/{id}', 'NotificationController@delete')->name('delete');

        });
    /*...............................Notification Controller..............................*/
    Route::prefix('reward')->name('reward.')->group(
        function () {
            Route::get('/', 'RewardController@index')->name('list');
            Route::post('/create', 'RewardController@create')->name('create');
            Route::put('/edit/{id}', 'RewardController@edit')->name('edit');
            Route::get('/delete/{id}', 'RewardController@delete')->name('delete');
        });

    /*...............................Delivery Controller..............................*/
    Route::prefix('delivery')->name('delivery.')->group(
        function () {
            Route::get('/', 'DeliveryController@index')->name('list');
            Route::post('/create', 'DeliveryController@store')->name('store');
            Route::get('/edit/{id}', 'DeliveryController@edit')->name('edit');
            Route::put('/update/{id}', 'DeliveryController@update')->name('update');
            Route::get('/delete/{id}', 'DeliveryController@delete')->name('delete');
        });
    /*...............................Contact Controller..............................*/
    Route::prefix('message')->middleware('role:admin')->name('contact.')->group(
        function () {

            Route::get('/', 'ContactController@index')->name('list');
            Route::get('/delete/{id}', 'ContactController@delete')->name('delete');

        });
    /*...............................Commission Controller..............................*/
    Route::prefix('commission')->middleware('role:admin')->name('commissions.')->group(
        function () {

            Route::get('/', 'CommissionController@index')->name('list');
            Route::get('/create', 'CommissionController@create')->name('create');
            Route::post('/store', 'CommissionController@store')->name('store');
            Route::put('/edit/{id}', 'CommissionController@edit')->name('edit');

            Route::post('/pay_to_seller', 'CommissionController@pay_to_seller')->name('pay_to_seller');


            Route::get('/delete/{id}', 'CommissionController@delete')->name('delete');

        });/*.......................................Brand  ontroller................................................*/;


    Route::resource('brands', 'BrandController');
    Route::get('/brands/destroy/{id}', 'BrandController@destroy')->name('brands.destroy');/*.......................................Field List------------------------------------------------------*/;
    Route::name('fields.')->prefix('fields')->group(function () {
        Route::get('/', 'FieldController@index')->name('list');
    });/*.......................................Variation List------------------------------------------------------*/;
    Route::name('variations.')->prefix('variations')->group(function () {
        Route::post('/store', 'VariationController@store')->name('store');
        Route::get('/delete/{id}', 'VariationController@delete')->name('delete');

    });/*.......................................Afiliate System------------------------------------------------------*/;

    Route::get('/affiliate', 'AffiliateController@index')->name('affiliate.index');
    Route::post('/affiliate/affiliate_option_store', 'AffiliateController@affiliate_option_store')->name('affiliate.store');

    Route::get('/affiliate/configs', 'AffiliateController@configs')->name('affiliate.configs');
    Route::post('/affiliate/configs/store', 'AffiliateController@config_store')->name('affiliate.configs.store');

    Route::get('/affiliate/users', 'AffiliateController@users')->name('affiliate.users');
    Route::get('/affiliate/verification/{id}', 'AffiliateController@show_verification_request')->name('affiliate_users.show_verification_request');

    Route::get('/affiliate/approve/{id}', 'AffiliateController@approve_user')->name('affiliate_user.approve');
    Route::get('/affiliate/reject/{id}', 'AffiliateController@reject_user')->name('affiliate_user.reject');

    Route::post('/affiliate/approved', 'AffiliateController@updateApproved')->name('affiliate_user.approved');

    Route::post('/affiliate/payment_modal', 'AffiliateController@payment_modal')->name('affiliate_user.payment_modal');
    Route::post('/affiliate/pay/store', 'AffiliateController@payment_store')->name('affiliate_user.payment_store');

    Route::get('/affiliate/payments/show/{id}', 'AffiliateController@payment_history')->name('affiliate_user.payment_history');
    Route::get('/refferal/users', 'AffiliateController@refferal_users')->name('refferals.users');

    Route::name('roles_permission.')->middleware('role:admin')->prefix('rolespermission')->group(function () {
        Route::get('/', 'RolesPermissionController@index')->name('index');
        Route::get('/roles', 'RolesPermissionController@roles')->name('roles');

    });/*.......................................Permisssion System------------------------------------------------------*/;
    Route::name('permissions.')->middleware('role:admin')->prefix('permission')->group(function () {
        Route::post('/create', 'RolesPermissionController@createPermission')->name('create');
        Route::post('/update', 'RolesPermissionController@updatePermission')->name('update');
        Route::post('/delete', 'RolesPermissionController@deletePermission')->name('delete');

    });/*.......................................Permisssion System------------------------------------------------------*/;
    Route::name('roles.')->middleware('role:admin')->prefix('roles')->group(function () {
        Route::post('/create', 'RolesPermissionController@createRoles')->name('create');
        Route::post('/update', 'RolesPermissionController@updateRoles')->name('update');
        Route::get('/delete/{id}', 'RolesPermissionController@deleteRoles')->name('delete');
    });/*.......................................API Intregration------------------------------------------------------*/;
    Route::name('api.')->middleware('role:admin')->prefix('apiintregation')->group(function () {
        Route::get('/googleanalytics', 'ApiIntregationController@googleAnalytics')->name('google.analytics');
        Route::post('create/googleanalytics', 'ApiIntregationController@googleAnalyticsStore')->name('google.analytics.create');
        Route::get('checkout', 'ApiIntregationController@checkoutIntregation')->name('checkout');
        Route::post('checkout/paypal', 'ApiIntregationController@checkoutIntregationstore')->name('checkout.paypal');
        Route::post('checkout/esewa', 'ApiIntregationController@checkoutIntregationEsewa')->name('checkout.esewa');
        Route::get('gmail', 'ApiIntregationController@gmailIndex')->name('gmail');
        Route::post('gmail/store', 'ApiIntregationController@gmailIntregation')->name('gmail.store');
    });

    /*........................................Shipping Configurations.........................................*/

    Route::get('/shipping_configuration', 'BusinessSettingsController@shipping_configuration')->name('shipping_configuration.index');
    Route::post('/shipping_configuration/update', 'BusinessSettingsController@shipping_configuration_update')->name('shipping_configuration.update');


    Route::post('/business-settings/update', 'BusinessSettingsController@update')->name('business_settings.update');
    Route::post('/business-settings/update/activation', 'BusinessSettingsController@updateActivationSettings')->name('business_settings.update.activation');

    Route::post('/products/get_products_by_subsubcategory', 'ProductController@get_products_by_subsubcategory')->name('products.get_products_by_subsubcategory');

    Route::name('sales.')->prefix('sale')->group(function () {
        Route::get('/{id}/show', 'OrderController@sales_show')->name('show');
        Route::get('/', 'OrderController@sales');
    });

    Route::middleware('role:admin')->group(function () {
    Route::resource('sellers', 'SellerController');
    Route::get('/sellers/destroy/{id}', 'SellerController@destroy')->name('sellers.destroy');
    Route::get('/sellers/view/{id}/verification', 'SellerController@show_verification_request')->name('sellers.show_verification_request');
    Route::get('/sellers/approve/{id}', 'SellerController@approve_seller')->name('sellers.approve');
    Route::get('/sellers/reject/{id}', 'SellerController@reject_seller')->name('sellers.reject');
    Route::post('/sellers/payment_modal', 'SellerController@payment_modal')->name('sellers.payment_modal');
    Route::get('/seller/payments', 'PaymentController@payment_histories')->name('sellers.payment_histories');
    Route::get('/seller/payments/show/{id}', 'PaymentController@show')->name('sellers.payment_history');
    Route::post('/sellers/profile_modal', 'SellerController@profile_modal')->name('sellers.profile_modal');
    Route::post('/sellers/approved', 'SellerController@updateApproved')->name('sellers.approved');
    });

    Route::resource('countries', 'CountryController');
    Route::post('/countries/status', 'CountryController@updateStatus')->name('countries.status');

    Route::resource('flash_deals', 'FlashDealController');
    Route::get('/flash_deals/destroy/{id}', 'FlashDealController@destroy')->name('flash_deals.destroy');
    Route::post('/flash_deals/update_status', 'FlashDealController@update_status')->name('flash_deals.update_status');
    Route::post('/flash_deals/update_featured', 'FlashDealController@update_featured')->name('flash_deals.update_featured');
    Route::post('/flash_deals/product_discount', 'FlashDealController@product_discount')->name('flash_deals.product_discount');
    Route::post('/flash_deals/product_discount_edit', 'FlashDealController@product_discount_edit')->name('flash_deals.product_discount_edit');
    Route::post('/subcategories/get_subcategories_by_category', 'ProductController@get_subcategories_by_category')->name('subcategories.get_subcategories_by_category');
    Route::post('/subsubcategories/get_subsubcategories_by_subcategory', 'ProductController@get_subsubcategories_by_subcategory')->name('subsubcategories.get_subsubcategories_by_subcategory');

    Route::get('invoice/customer/{order_id}', 'InvoiceController@customer_invoice_download')->name('customer.invoice.download');
    Route::get('invoice/seller/{order_id}', 'InvoiceController@seller_invoice_download')->name('seller.invoice.download');


//    Route::resource('/withdraw_requests', 'SellerWithdrawRequestController');
//    Route::get('/withdraw_requests_all', 'SellerWithdrawRequestController@request_index')->name('withdraw_requests_all');
//    Route::post('/withdraw_request/payment_modal', 'SellerWithdrawRequestController@payment_modal')->name('withdraw_request.payment_modal');
//    Route::post('/withdraw_request/message_modal', 'SellerWithdrawRequestController@message_modal')->name('withdraw_request.message_modal');

    Route::resource('customer_packages', 'CustomerPackageController');
    Route::get('/customer_packages/destroy/{id}', 'CustomerPackageController@destroy')->name('customer_packages.destroy');

    Route::resource('customers', 'CustomerController');
    Route::get('/customers/destroy/{id}', 'CustomerController@destroy')->name('customers.destroy');


    Route::post('/business-settings/update', 'BusinessSettingsController@update')->name('business_settings.update');
    Route::post('/business-settings/update/activation', 'BusinessSettingsController@updateActivationSettings')->name('business_settings.update.activation');
    Route::get('/activation', 'BusinessSettingsController@activation')->name('activation.index');
    Route::get('/payment-method', 'BusinessSettingsController@payment_method')->name('payment_method.index');
    Route::get('/social-login', 'BusinessSettingsController@social_login')->name('social_login.index');
    Route::get('/smtp-settings', 'BusinessSettingsController@smtp_settings')->name('smtp_settings.index');
    Route::get('/google-analytics', 'BusinessSettingsController@google_analytics')->name('google_analytics.index');
    Route::get('/facebook-chat', 'BusinessSettingsController@facebook_chat')->name('facebook_chat.index');
    Route::post('/env_key_update', 'BusinessSettingsController@env_key_update')->name('env_key_update.update');
    Route::post('/payment_method_update', 'BusinessSettingsController@payment_method_update')->name('payment_method.update');
    Route::post('/google_analytics', 'BusinessSettingsController@google_analytics_update')->name('google_analytics.update');
    Route::post('/facebook_chat', 'BusinessSettingsController@facebook_chat_update')->name('facebook_chat.update');
    Route::post('/facebook_pixel', 'BusinessSettingsController@facebook_pixel_update')->name('facebook_pixel.update');
    Route::get('/currency', 'CurrencyController@currency')->name('currency.index');
    Route::post('/currency/update', 'CurrencyController@updateCurrency')->name('currency.update');
    Route::post('/your-currency/update', 'CurrencyController@updateYourCurrency')->name('your_currency.update');
    Route::get('/currency/create', 'CurrencyController@create')->name('currency.create');
    Route::post('/currency/store', 'CurrencyController@store')->name('currency.store');
    Route::post('/currency/currency_edit', 'CurrencyController@edit')->name('currency.edit');
    Route::post('/currency/update_status', 'CurrencyController@update_status')->name('currency.update_status');

    Route::get('/disputes', 'DisputeController@index')->name('disputes');
    Route::post('/disputes/status-update/{id}', 'DisputeController@statusUpdate')->name('disputes.status_update');
    Route::get('/disputes/details/{id}', 'DisputeController@viewDetails')->name('disputes.view_details');
    Route::post('/dispute/result', 'DisputeController@resultStore')->name('dispute.result_store');
    Route::get('/reload', 'DisputeController@reload')->name('message.reload');
    Route::post('/disputes/store/{id}', 'DisputeController@storeDisputes')->name('disputes.store');

         Route::get('/support_ticket/admin', 'SupportTicketController@admin_index')->name('support_ticket.admin_index');
    Route::get('support_ticket/{id}/show', 'SupportTicketController@admin_show')->name('support_ticket.admin_show');
    Route::post('support_ticket/reply/store', 'SupportTicketController@admin_store')->name('support_ticket.admin_store');



    Route::get('/categories/destroy/{id}', 'CategoryController@destroy')->name('categories.destroy');
    Route::post('/categories/featured', 'CategoryController@updateFeatured')->name('categories.featured');

    Route::group(['middleware' => ['auth','role:vendor']], function () {
        Route::get('/vendor-products','ProductController@seller_products')->name('seller.products');
    });

    Route::post('/subcategories/get_subcategories_by_category', 'SubCategoryController@get_subcategories_by_category')->name('subcategories.get_subcategories_by_category');
    Route::post('/subsubcategories/get_subsubcategories_by_subcategory', 'SubSubCategoryController@get_subsubcategories_by_subcategory')->name('subsubcategories.get_subsubcategories_by_subcategory');
    Route::post('/subsubcategories/get_brands_by_subsubcategory', 'SubSubCategoryController@get_brands_by_subsubcategory')->name('subsubcategories.get_brands_by_subsubcategory');
    Route::post('/subsubcategories/get_attributes_by_subsubcategory', 'SubSubCategoryController@get_attributes_by_subsubcategory')->name('subsubcategories.get_attributes_by_subsubcategory');


    Route::resource('attributes','AttributeController');
    Route::get('/attributes/destroy/{id}', 'AttributeController@destroy')->name('attributes.destroy');

    Route::get('/frontend_settings/home', 'HomeController@home_settings')->name('home_settings.index');
    Route::post('/frontend_settings/home/top_10', 'HomeController@top_10_settings')->name('top_10_settings.store');


    Route::group(['prefix' => 'frontend_settings'], function () {
        Route::resource('sliders', 'SliderController');
        Route::get('/sliders/destroy/{id}', 'SliderController@destroy')->name('sliders.destroy');

        Route::resource('home_banners', 'BannerController');
        Route::get('/home_banners/create/{position}', 'BannerController@create')->name('home_banners.create');
        Route::post('/home_banners/update_status', 'BannerController@update_status')->name('home_banners.update_status');
        Route::get('/home_banners/destroy/{id}', 'BannerController@destroy')->name('home_banners.destroy');

        Route::resource('home_categories', 'HomeCategoryController');
        Route::get('/home_categories/destroy/{id}', 'HomeCategoryController@destroy')->name('home_categories.destroy');
        Route::post('/home_categories/update_status', 'HomeCategoryController@update_status')->name('home_categories.update_status');
        Route::post('/home_categories/get_subsubcategories_by_category', 'HomeCategoryController@getSubSubCategories')->name('home_categories.get_subsubcategories_by_category');
    });

    Route::resource('support_ticket','SupportTicketController');
    Route::post('support_ticket/reply','SupportTicketController@seller_store')->name('support_ticket.seller_store');

    Route::resource('subcategories', 'SubCategoryController');
    Route::get('/subcategories/destroy/{id}', 'SubCategoryController@destroy')->name('subcategories.destroy');

    Route::resource('subsubcategories', 'SubSubCategoryController');
    Route::get('/subsubcategories/destroy/{id}', 'SubSubCategoryController@destroy')->name('subsubcategories.destroy');

    Route::resource('/withdraw_requests', 'SellerWithdrawRequestController');
    Route::get('/withdraw_requests_all', 'SellerWithdrawRequestController@request_index')->name('withdraw_requests_all');
    Route::post('/withdraw_request/payment_modal', 'SellerWithdrawRequestController@payment_modal')->name('withdraw_request.payment_modal');
    Route::post('/withdraw_request/message_modal', 'SellerWithdrawRequestController@message_modal')->name('withdraw_request.message_modal');

    Route::resource('conversations','ConversationController');
	Route::post('conversations/refresh','ConversationController@refresh')->name('conversations.refresh');
	Route::resource('messages','MessageController');


	Route::post('refund-request-send/{id}', 'RefundRequestController@request_store')->name('refund_request_send');
    Route::get('refund-request', 'RefundRequestController@vendor_index')->name('vendor_refund_request');
    Route::get('sent-refund-request', 'RefundRequestController@customer_index')->name('customer_refund_request');
    Route::post('refund-reuest-vendor-approval', 'RefundRequestController@request_approval_vendor')->name('vendor_refund_approval');
    Route::get('refund-request/{id}', 'RefundRequestController@refund_request_send_page')->name('refund_request_send_page');

	Route::get('/reviews', 'ReviewController@seller_reviews')->name('reviews.seller');

    Route::get('/vendor_commission', 'BusinessSettingsController@vendor_commission')->name('business_settings.vendor_commission');
    Route::post('/vendor_commission_update', 'BusinessSettingsController@vendor_commission_update')->name('business_settings.vendor_commission.update');

});
