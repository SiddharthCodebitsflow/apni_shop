<?php

use App\Http\Controllers\Vendor\RedirectSession;
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

Route::middleware(['vendor_auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\Vendor\RedirectSession::class, 'home']);
    Route::get('/logout', [App\Http\Controllers\Vendor\RedirectSession::class, 'logout']);
    Route::get('/add-new-product', [App\Http\Controllers\Vendor\AddProduct::class, 'add_new_product']);
    Route::get('/attributes', [App\Http\Controllers\Vendor\RedirectSession::class, 'attributes']);
    Route::get('/update-attribute/{id}', [App\Http\Controllers\Vendor\RedirectSession::class, 'update_attribute']);
    Route::get('/category', [App\Http\Controllers\Vendor\RedirectSession::class, 'category']);
    Route::get('/update-category/{id}', [App\Http\Controllers\Vendor\RedirectSession::class, 'update_category']);
    Route::get('/all-product', [App\Http\Controllers\Vendor\RedirectSession::class, 'vendor_all_product']);
    Route::get('/tresh-product', [App\Http\Controllers\Vendor\RedirectSession::class, 'product_tresh']);
    Route::get('/vendor-cart', [App\Http\Controllers\Vendor\RedirectSession::class, 'add_to_cart']);
    Route::get('/about-product/{id}', [App\Http\Controllers\Vendor\RedirectSession::class, 'about_product']);
    Route::get('/profile', [App\Http\Controllers\Vendor\RedirectSession::class, 'profile']);
    Route::get('/all-order', [App\Http\Controllers\Vendor\RedirectSession::class, 'all_order']);
});

Route::get('/', [App\Http\Controllers\Vendor\RedirectSession::class, 'index']);

Route::post('/session', [App\Http\Controllers\Vendor\RedirectSession::class, 'session']);

Route::get('vendor-register', [App\Http\Controllers\Vendor\RedirectSession::class, 'vendor_register']);

Route::get('login', [App\Http\Controllers\Vendor\RedirectSession::class, 'login']);

Route::get('forget-password', [App\Http\Controllers\Vendor\RedirectSession::class, 'forget_password']);

Route::get('user-home', [App\Http\Controllers\User\Redirect::class, 'home']);

Route::get('/user-about-product/{id}', [App\Http\Controllers\User\Redirect::class, 'product_about']);

Route::get('user-register',[App\Http\Controllers\User\Redirect::class,'user_register']);

Route::get('user-login',[App\Http\Controllers\User\Redirect::class,'user_login']);

Route::post('user-session',[App\Http\Controllers\User\Redirect::class,'user_session']);

Route::get('user-logout',[App\Http\Controllers\User\Redirect::class,'user_logout']);

Route::get('user-cart',[App\Http\Controllers\User\Redirect::class,'user_cart'])->middleware('user_login');

Route::get('checkout/{id}',[App\Http\Controllers\User\Redirect::class,'process_to_checkout'])->middleware('user_login');

Route::get('order-checkout',[App\Http\Controllers\User\Redirect::class,'checkout'])->middleware('user_login');

Route::post('search',[App\Http\Controllers\User\Redirect::class,'search'])->name('search');

// Route::get('/add-cart/{id}/{qty}', [App\Http\Controllers\User\Redirect::class, 'add_to_cart_cookie']);

