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
Auth::routes();
// Route::group(['middleware' => 'guest'], function () {
//     Route::match(['get', 'post'], '/login', [App\Http\Controllers\Front\UserController::class, 'index'])->name('login');
// });
Route::group(['middleware' => 'auth'], function () {
    Route::get('/account', [App\Http\Controllers\Front\AccountController::class, 'index'])->name('account');
});
