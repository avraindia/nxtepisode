<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\ProductContent;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\HomepageController;

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

////////// route of admin start ////////////
Route::get('/admin', [AdminController::class, 'signin'])->name('signin');
Route::post('/adminlogin',[AdminController::class, 'adminlogin'])->name('adminlogin');
Route::get('/admin-logout', [AdminController::class, 'adminlogout'])->name('adminlogout');

Route::get('/forget-password', [AdminController::class, 'forget_password'])->name('forget_password');

Route::group(['middleware' => 'auth:webadmin'], function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/admin/chart-data', [AdminController::class, 'chart_data'])->name('chart_data');
    Route::get('/admin/site-settings', [AdminController::class, 'site_settings'])->name('site_settings');
    Route::post('/admin/save-settings', [AdminController::class, 'save_settings'])->name('save_settings');

    /// User Route
    Route::get('/admin/users', [AdminController::class, 'users'])->name('users');
    Route::post('/admin/filtering-user-paginate-result', [AdminController::class, 'filtering_user_paginate_result'])->name('filtering_user_paginate_result');
    Route::get('/admin/add-user', [AdminController::class, 'add_user'])->name('add_user');
    Route::post('/admin/save-user', [AdminController::class, 'save_user'])->name('save_user');
    Route::post('/admin/update-user', [AdminController::class, 'update_user'])->name('update_user');
    Route::post('/admin/change-user-permission', [AdminController::class, 'change_user_permission'])->name('change_user_permission');
    Route::get('/admin/user-details/{id}', [AdminController::class, 'user_details'])->name('user_details');
    Route::get('/admin/change-user', [AdminController::class, 'change_user'])->name('change_user');
    Route::post('/admin/update-admin', [AdminController::class, 'update_admin'])->name('update_admin');
    Route::get('/admin/change-password', [AdminController::class, 'change_password'])->name('change_password');
    Route::post('/admin/update-password', [AdminController::class, 'update_password'])->name('update_password');

    /// Customer Route
    Route::get('/admin/customers', [AdminController::class, 'customers'])->name('customers');
    Route::get('/admin/customer-details/{id}', [AdminController::class, 'customer_details'])->name('customer_details');
    Route::post('/admin/change-customer-status', [AdminController::class, 'change_customer_status'])->name('change_customer_status');
    Route::post('/admin/filtering-customer-paginate-result', [AdminController::class, 'filtering_customer_paginate_result'])->name('filtering_customer_paginate_result');

    /// Category Route
    Route::get('/admin/all-categories', [ProductContent::class, 'view_categories'])->name('all_categories');
    Route::get('/admin/add-category', [ProductContent::class, 'add_category'])->name('add_category');
    Route::get('/admin/edit-category/{id}', [ProductContent::class, 'edit_category'])->name('edit_category');
    Route::post('/admin/update-category', [ProductContent::class, 'update_category'])->name('update_category');
    Route::post('/admin/save-category', [ProductContent::class, 'save_category'])->name('save_category');
    Route::post('/admin/fetch-child-category', [ProductContent::class, 'fetch_child_category'])->name('fetch_child_category');
    Route::get('/admin/category-delete/{id}', [ProductContent::class, 'category_delete'])->name('category_delete');

    /// Homepage Route
    Route::get('/admin/all-sections', [HomepageController::class, 'all_sections'])->name('all_sections');
    Route::get('/admin/add-homepage-section', [HomepageController::class, 'add_homepage_section'])->name('add_homepage_section');
    Route::post('/admin/save-homepage-section', [HomepageController::class, 'save_homepage_section'])->name('save_homepage_section');
    Route::get('/admin/edit-homepage-section/{id}', [HomepageController::class, 'edit_homepage_section'])->name('edit_homepage_section');
    Route::get('/admin/add-section-product/{id}', [HomepageController::class, 'add_section_product'])->name('add_section_product');
    Route::post('/admin/add-homepage-section-product', [HomepageController::class, 'add_homepage_section_product'])->name('add_homepage_section_product');
    Route::post('/admin/filtering-section-product', [HomepageController::class, 'filtering_section_product'])->name('filtering_section_product');
    Route::get('/admin/add-collection/{id}', [HomepageController::class, 'add_collection'])->name('add_collection');
    Route::post('/admin/save-collection-item', [HomepageController::class, 'save_collection_item'])->name('save_collection_item');
    Route::get('/admin/collection-list/{id}', [HomepageController::class, 'collection_list'])->name('collection_list');
    Route::get('/admin/collection-product/{id}', [HomepageController::class, 'collection_product'])->name('collection_product');
    Route::post('/admin/filtering-collection-product', [HomepageController::class, 'filtering_collection_product'])->name('filtering_collection_product');
    Route::post('/admin/add-homepage-collection-product', [HomepageController::class, 'add_homepage_collection_product'])->name('add_homepage_collection_product');
    Route::get('/admin/edit-collection/{id}', [HomepageController::class, 'edit_collection'])->name('edit_collection');
    Route::post('/admin/update-collection-item', [HomepageController::class, 'update_collection_item'])->name('update_collection_item');
    Route::get('/admin/delete-collection-item/{id}', [HomepageController::class, 'delete_collection_item'])->name('delete_collection_item');
    Route::get('/admin/add-banner-image/{type}', [HomepageController::class, 'add_banner_image'])->name('add_banner_image');
    Route::post('/admin/save-banner-image', [HomepageController::class, 'save_banner_image'])->name('save_banner_image');
    Route::get('/admin/delete-banner-image/{id}', [HomepageController::class, 'delete_banner_image'])->name('delete_banner_image');

    //// Product Route
    Route::get('/admin/all-products', [ProductController::class, 'all_products'])->name('all_products');
    Route::get('/admin/add-product', [ProductController::class, 'add_product'])->name('add_product');
    Route::post('/admin/save-product', [ProductController::class, 'save_product'])->name('save_product');
    Route::get('/admin/product-details/{id}', [ProductController::class, 'product_details'])->name('product_details');
    Route::post('/admin/update-product', [ProductController::class, 'update_product'])->name('update_product');
    Route::post('/admin/delete-product-image', [ProductController::class, 'delete_product_image'])->name('delete_product_image');
    Route::post('/admin/filtering-product-paginate-result', [ProductController::class, 'filtering_product_paginate_result'])->name('filtering_product_paginate_result');

    //// Options Route
    Route::get('/admin/options', [ProductContent::class, 'options'])->name('options');
    Route::post('/admin/save-option', [ProductContent::class, 'save_option'])->name('save_option');
    Route::get('/admin/add-option-value/{option_id}', [ProductContent::class, 'add_option_value'])->name('add_option_value');
    Route::get('/admin/delete-option/{option_id}', [ProductContent::class, 'delete_option'])->name('delete_option');
    Route::post('/admin/fetch-option-record', [ProductContent::class, 'fetch_option_record'])->name('fetch_option_record');
    Route::post('/admin/save-option-value', [ProductContent::class, 'save_option_value'])->name('save_option_value');
    Route::post('/admin/fetch-option-value', [ProductContent::class, 'fetch_option_value'])->name('fetch_option_value');
    Route::post('/admin/delete-option-value', [ProductContent::class, 'delete_option_value'])->name('delete_option_value');

    //// Inventory Route
    Route::get('/admin/inventory', [ProductContent::class, 'inventory'])->name('inventory');
    Route::get('/admin/inventory-list', [ProductContent::class, 'inventory_list'])->name('inventory_list');
    Route::post('/admin/filtering-inventory-paginate-result', [ProductContent::class, 'filtering_inventory_paginate_result'])->name('filtering_inventory_paginate_result');
    Route::post('/admin/search-inventory-product', [ProductContent::class, 'search_inventory_product'])->name('search_inventory_product');
    Route::post('/admin/inventory-option-value', [ProductContent::class, 'inventory_option_value'])->name('inventory_option_value');
    Route::post('/admin/check-existing-stock', [ProductContent::class, 'check_existing_stock'])->name('check_existing_stock');
    Route::post('/admin/save-inventory-value', [ProductContent::class, 'save_inventory_value'])->name('save_inventory_value');

    //// Theme Route
    Route::get('/admin/themes', [ProductContent::class, 'themes'])->name('themes');
    Route::post('/admin/save-theme', [ProductContent::class, 'save_theme'])->name('save_theme');
    Route::get('/admin/delete-theme/{theme_id}', [ProductContent::class, 'delete_theme'])->name('delete_theme');
    Route::post('/admin/fetch-theme-record', [ProductContent::class, 'fetch_theme_record'])->name('fetch_theme_record');

    /// Product variation Route
    Route::get('/admin/add-variation/{id}', [ProductContent::class, 'add_variation'])->name('add_variation');
    Route::post('/admin/save-variation', [ProductContent::class, 'save_variation'])->name('save_variation');
    Route::post('/admin/fetch-existing-fitting-type', [ProductContent::class, 'fetch_existing_fitting_type'])->name('fetch_existing_fitting_type');
    Route::get('/admin/fitting-list/{id}', [ProductContent::class, 'fitting_list'])->name('fitting_list');
    Route::post('/admin/filtering-fitting-paginate-result', [ProductContent::class, 'filtering_fitting_paginate_result'])->name('filtering_fitting_paginate_result');
    Route::get('/admin/review/{id}', [ProductContent::class, 'fetch_review'])->name('fetch_review');
    Route::post('/admin/change-review-status', [ProductContent::class, 'change_review_status'])->name('change_review_status');

    /// Order details Route
    Route::get('/admin/all-order', [AdminController::class, 'orders'])->name('all_order');
    Route::get('/admin/order-details/{id}', [AdminController::class, 'view_order'])->name('view_order');
    Route::post('/admin/submit-courier', [AdminController::class, 'submit_courier'])->name('submit_courier');
    Route::get('/admin/get-status-id/{id}', [AdminController::class, 'get_status_id'])->name('get_status_id');
    Route::post('/admin/order-pack', [AdminController::class, 'order_pack'])->name('order_pack');
    Route::post('/admin/order-on-way', [AdminController::class, 'order_on_way'])->name('order_on_way');
    Route::post('/admin/order-delivered', [AdminController::class, 'order_delivered'])->name('order_delivered');
    Route::post('/admin/cancel-order', [AdminController::class, 'cancel_order'])->name('cancel_order');
    Route::post('/admin/filtering-order-paginate-result', [AdminController::class, 'filtering_order_paginate_result'])->name('filtering_order_paginate_result');
 
});

////////// route of frontend start ////////////
Route::get('/', [HomepageController::class, 'home'])->name('home');

Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/submit-register-form', [UserController::class, 'submit_register_form'])->name('submit_register_form');
Route::get('/login', [UserController::class, 'frontlogin'])->name('frontlogin');
Route::get('/logout', [UserController::class, 'frontlogout'])->name('frontlogout');
Route::post('/submit-login-form', [UserController::class, 'submit_login_form'])->name('submit_login_form');

Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('/auth/google/call-back', [GoogleAuthController::class, 'callbackGoogle']);

Route::get('/products', [ProductController::class, 'products'])->name('products');
Route::post('/filtering_paginate_result', [ProductController::class, 'filtering_paginate_result'])->name('filtering_paginate_result');
Route::post('/search-product-list', [ProductController::class, 'search_product_list'])->name('search_product_list');
Route::get('/product-details/{id}', [ProductController::class, 'front_product_details'])->name('front_product_details');
Route::post('/check-variation-exists', [ProductController::class, 'check_variation_exists'])->name('check_variation_exists');
Route::post('/add-to-cart', [ProductController::class, 'add_to_cart'])->name('add_to_cart');
Route::post('/fetch-show-more-product-review', [ProductController::class, 'fetch_show_more_product_review'])->name('fetch_show_more_product_review');
Route::get('/wishlist', [ProductController::class, 'wishlist'])->name('wishlist');
Route::post('/filtering-wishlist-result', [ProductController::class, 'filtering_wishlist_result'])->name('filtering_wishlist_result');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/check-email', [UserController::class, 'check_email'])->name('check_email');
    Route::post('/update-profile', [UserController::class, 'update_profile'])->name('update_profile');
    Route::get('/cart', [ProductController::class, 'cart'])->name('cart');
    Route::post('/update-cart', [ProductController::class, 'updateCart'])->name('cart.update');
    Route::post('/remove-cart', [ProductController::class, 'removeCart'])->name('cart.remove');
    Route::get('/count-cart', [ProductController::class, 'countCart'])->name('cart.count');
    Route::post('/check-promo-code', [ProductController::class, 'check_promo_code'])->name('check_promo_code');
    Route::any('/checkout', [ProductController::class, 'checkout'])->name('checkout');
    Route::post('/submit-checkout', [ProductController::class, 'submit_checkout'])->name('submit_checkout');
    Route::post('/save-checkout-address', [ProductController::class, 'save_checkout_address'])->name('save_checkout_address');
    Route::post('/fetch-saved-address', [ProductController::class, 'fetch_saved_address'])->name('fetch_saved_address');
    Route::post('/fetch-address-for-edit', [ProductController::class, 'fetch_address_for_edit'])->name('fetch_address_for_edit');
    Route::post('/edit-checkout-address', [ProductController::class, 'edit_checkout_address'])->name('edit_checkout_address');
    Route::post('/delete-saved-address', [ProductController::class, 'delete_saved_address'])->name('delete_saved_address');
    Route::any('/payment', [ProductController::class, 'payment'])->name('payment');
    Route::any('/payment-submit', [PaymentController::class, 'payment_submit'])->name('payment_submit');
    Route::any('/cashfree/payments/success', [ProductController::class, 'cashfree_success'])->name('cashfree_success');
    Route::post('/order', [ProductController::class, 'order'])->name('order');
    Route::get('/order-success/{id}', [ProductController::class, 'order_success'])->name('order_success');
    Route::get('/my-order', [ProductController::class, 'my_order'])->name('my_order');
    Route::post('/filtering-my-order', [ProductController::class, 'filtering_my_order'])->name('filtering_my_order');
    Route::get('/order-details/{id}', [ProductController::class, 'order_details'])->name('order_details');
    Route::post('/submit-product-review', [ProductController::class, 'submit_product_review'])->name('submit_product_review');
    Route::post('/fetch-product-review', [ProductController::class, 'fetch_product_review'])->name('fetch_product_review');
    Route::post('/fetch-if_product-purchased', [ProductController::class, 'fetch_if_product_purchased'])->name('fetch_if_product_purchased');
    Route::get('/product-exchange/{id}', [ProductController::class, 'product_exchange'])->name('product_exchange');
    Route::post('/submit-exchange', [ProductController::class, 'submit_exchange'])->name('submit_exchange');
    Route::post('/fetch-exchange-issue', [ProductController::class, 'fetch_exchange_issue'])->name('fetch_exchange_issue');
    Route::get('/exchange-product-details/{id}', [ProductController::class, 'exchange_product_details'])->name('exchange_product_details');
    Route::any('/exchange-checkout', [ProductController::class, 'exchange_checkout'])->name('exchange_checkout');
    Route::post('/exchange-payment', [ProductController::class, 'exchange_payment'])->name('exchange_payment');
    Route::post('/admin/front-cancel-order', [ProductController::class, 'front_cancel_order'])->name('front_cancel_order');
});

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return 'Application cache has been cleared';
});

Route::get('/view-clear', function() {
    Artisan::call('view:clear');
    return 'View cache has been cleared';
});
