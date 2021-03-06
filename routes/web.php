<?php

use Illuminate\Support\Facades\Auth;
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



Route::get('/', [App\Http\Controllers\Front\HomeController::class, 'index'])->name('home');

// Route::get('/login', [App\Http\Controllers\Front\UserController::class, 'index'])->name('login');
// Route::get('/logout', [App\Http\Controllers\Front\UserController::class, 'logout'])->name('user.logout');
// Route::get('/forgot-password', [App\Http\Controllers\Front\UserController::class, 'forgot'])->name('password.forgot');
// Route::get('/register', [App\Http\Controllers\Front\UserController::class, 'form'])->name('register');
// Route::post('/company/save/{id?}', [App\Http\Controllers\Front\UserController::class, 'save'])->name('company.save');
// Auth::routes();
Route::group(['middleware' => 'guest'], function () {
    Route::match(['get', 'post'], '/login', [App\Http\Controllers\Front\UserController::class, 'index'])->name('login');
    Route::get('/register', [App\Http\Controllers\Front\UserController::class, 'form'])->name('register');
    Route::get('/forgot-password', [App\Http\Controllers\Front\UserController::class, 'forgot'])->name('password.request');
    Route::post('/reset-password', [App\Http\Controllers\Front\UserController::class, 'reset'])->name('password.reset');
    // Route::match(['get', 'post'], '/forgot-password', [App\Http\Controllers\Front\UserController::class, 'forgot'])->name('password.request');
});
Route::group(['middleware' => 'user'], function () {
    Route::post('/logout', [App\Http\Controllers\Front\UserController::class, 'logout'])->name('logout');

    Route::group(['prefix' => 'account'], function () {
        Route::get('/', [App\Http\Controllers\Front\AccountController::class, 'index'])->name('account');
    });
    Route::group(['prefix' => 'payments'], function () {
        Route::get('/', [App\Http\Controllers\Front\PaymentController::class, 'index'])->name('payments');
        Route::get('/index_data', [App\Http\Controllers\Front\PaymentController::class, 'index_data'])->name('payments.index_data');
    });
    Route::get('/notifications', [App\Http\Controllers\Front\NotificationsController::class, 'index'])->name('notifications');

});
