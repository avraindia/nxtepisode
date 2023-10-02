<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\ProductContent;
use App\Http\Controllers\ProductController;

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

    /// User Route
    Route::get('/admin/users', [AdminController::class, 'users'])->name('users');
    Route::post('/admin/filtering-user-paginate-result', [AdminController::class, 'filtering_user_paginate_result'])->name('filtering_user_paginate_result');
    Route::get('/admin/add-user', [AdminController::class, 'add_user'])->name('add_user');
    Route::post('/admin/save-user', [AdminController::class, 'save_user'])->name('save_user');
    Route::post('/admin/update-user', [AdminController::class, 'update_user'])->name('update_user');
    Route::post('/admin/change-user-permission', [AdminController::class, 'change_user_permission'])->name('change_user_permission');
    Route::get('/admin/user-details/{id}', [AdminController::class, 'user_details'])->name('user_details');

    /// Customer Route
    Route::get('/admin/customers', [AdminController::class, 'customers'])->name('customers');
    Route::get('/admin/customer-details/{id}', [AdminController::class, 'customer_details'])->name('customer_details');

    /// Category Route
    Route::get('/admin/all-categories', [ProductContent::class, 'view_categories'])->name('all_categories');
    Route::get('/admin/add-category', [ProductContent::class, 'add_category'])->name('add_category');
    Route::get('/admin/edit-category/{id}', [ProductContent::class, 'edit_category'])->name('edit_category');
    Route::post('/admin/update-category', [ProductContent::class, 'update_category'])->name('update_category');
    Route::post('/admin/save-category', [ProductContent::class, 'save_category'])->name('save_category');
    Route::post('/admin/fetch-child-category', [ProductContent::class, 'fetch_child_category'])->name('fetch_child_category');
    Route::get('/admin/category-delete/{id}', [ProductContent::class, 'category_delete'])->name('category_delete');

    //// Product Route
    Route::get('/admin/all-products', [ProductController::class, 'all_products'])->name('all_products');
    Route::get('/admin/add-product', [ProductController::class, 'add_product'])->name('add_product');
    Route::post('/admin/save-product', [ProductController::class, 'save_product'])->name('save_product');
    Route::get('/admin/product-details/{id}', [ProductController::class, 'product_details'])->name('product_details');
    Route::post('/admin/update-product', [ProductController::class, 'update_product'])->name('update_product');
    Route::post('/admin/delete-product-image', [ProductController::class, 'delete_product_image'])->name('delete_product_image');

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
});

////////// route of frontend start ////////////
Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/submit-register-form', [UserController::class, 'submit_register_form'])->name('submit_register_form');
Route::get('/login', [UserController::class, 'frontlogin'])->name('frontlogin');
Route::get('/logout', [UserController::class, 'frontlogout'])->name('frontlogout');
Route::post('/submit-login-form', [UserController::class, 'submit_login_form'])->name('submit_login_form');

Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('/auth/google/call-back', [GoogleAuthController::class, 'callbackGoogle']);

Route::get('/products', [ProductController::class, 'products'])->name('products');
Route::post('/filtering_paginate_result', [ProductController::class, 'filtering_paginate_result'])->name('filtering_paginate_result');
Route::get('/product-details/{id}', [ProductController::class, 'front_product_details'])->name('front_product_details');
Route::post('/check-variation-exists', [ProductController::class, 'check_variation_exists'])->name('check_variation_exists');
Route::post('/add-to-cart', [ProductController::class, 'add_to_cart'])->name('add_to_cart');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/cart', [ProductController::class, 'cart'])->name('cart');
    Route::post('/update-cart', [ProductController::class, 'updateCart'])->name('cart.update');
    Route::post('/remove-cart', [ProductController::class, 'removeCart'])->name('cart.remove');
    Route::get('/count-cart', [ProductController::class, 'countCart'])->name('cart.count');
});

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});
