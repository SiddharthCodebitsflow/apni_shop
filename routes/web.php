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
    Route::get('/trush-product', [App\Http\Controllers\Vendor\RedirectSession::class, 'product_trush']);
});

Route::get('/', [App\Http\Controllers\Vendor\RedirectSession::class, 'index']);

Route::post('/session', [App\Http\Controllers\Vendor\RedirectSession::class, 'session']);

Route::get('vendor-register', [App\Http\Controllers\Vendor\RedirectSession::class, 'vendor_register']);

Route::get('login', [App\Http\Controllers\Vendor\RedirectSession::class, 'login']);

Route::get('forget-password', [App\Http\Controllers\Vendor\RedirectSession::class, 'forget_password']);


Route::get('user/user-register', function () {
    return view('user/user_register');
});
