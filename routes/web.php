<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GoogleAuthController;

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
    Route::get('/admin/users', [AdminController::class, 'users'])->name('users');
    Route::get('/admin/customers', [AdminController::class, 'customers'])->name('customers');
    Route::post('/admin/filtering-user-paginate-result', [AdminController::class, 'filtering_user_paginate_result'])->name('filtering_user_paginate_result');
    Route::get('/admin/add-user', [AdminController::class, 'add_user'])->name('add_user');
    Route::post('/admin/save-user', [AdminController::class, 'save_user'])->name('save_user');
    Route::post('/admin/update-user', [AdminController::class, 'update_user'])->name('update_user');
    Route::post('/admin/change-user-permission', [AdminController::class, 'change_user_permission'])->name('change_user_permission');
    Route::get('/admin/user-details/{id}', [AdminController::class, 'user_details'])->name('user_details');
    Route::get('/admin/customer-details/{id}', [AdminController::class, 'customer_details'])->name('customer_details');
});

////////// route of frontend start ////////////
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/submit-register-form', [UserController::class, 'submit_register_form'])->name('submit_register_form');
Route::get('/login', [UserController::class, 'frontlogin'])->name('frontlogin');
Route::post('/submit-login-form', [UserController::class, 'submit_login_form'])->name('submit_login_form');

Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('/auth/google/call-back', [GoogleAuthController::class, 'callbackGoogle']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'home'])->name('home');
});
