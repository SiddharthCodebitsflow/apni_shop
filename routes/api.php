<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register',[App\Http\Controllers\Api\User_registration::class,'vendor_register']);

Route::post('vendor-login',[App\Http\Controllers\Api\User_registration::class,'vendor_login']);

Route::post('forget-password',[App\Http\Controllers\Api\User_registration::class,'forget_password']);


Route::post('attribute',[App\Http\Controllers\Api\Vendor_attribute::class,'attribute']);

Route::post('get-attribute',[App\Http\Controllers\Api\Vendor_attribute::class,'get_attribute']);

Route::post('delete-att',[App\Http\Controllers\Api\Vendor_attribute::class,'delete_att']);

Route::post('get-single-att',[App\Http\Controllers\Api\Vendor_attribute::class,'get_single_att']);

Route::post('att-update',[App\Http\Controllers\Api\Vendor_attribute::class,'att_update']);

Route::post('add-category',[App\Http\Controllers\Api\Vendor_category::class,'insert_catgory']);

Route::post('get-category',[App\Http\Controllers\Api\Vendor_category::class,'get_category']);

Route::post('delete-cat',[App\Http\Controllers\Api\Vendor_category::class,'delete_category']);

Route::post('get-single-category',[App\Http\Controllers\Api\Vendor_category::class,'get_single_category']);

Route::post('category-update',[App\Http\Controllers\Api\Vendor_category::class,'category_update']);

Route::post('add-new-product',[App\Http\Controllers\Api\Product::class,'insert_product']);

Route::post('get-product',[App\Http\Controllers\Api\Product::class,'get_all_product_except_current_vendor']);

Route::post('get-vendor-product',[App\Http\Controllers\Api\Product::class,'get_all_product_of_current_vendor']);

Route::post('tresh-product',[App\Http\Controllers\Api\Product::class,'get_tresh_product']);

Route::post('recover-product',[App\Http\Controllers\Api\Product::class,'recover_product']);

Route::post('delete-product',[App\Http\Controllers\Api\Product::class,'delete_product']);

Route::post('delete-product-permanently',[App\Http\Controllers\Api\Product::class,'delete_product_permanently']);

Route::post('add-to-cart',[App\Http\Controllers\Api\Product::class,'add_to_cart']);

Route::post('vendor-cart',[App\Http\Controllers\Api\Product::class,'vendor_cart_product']);

Route::post('remove-cart',[App\Http\Controllers\Api\Product::class,'remove_product_from_cart']);

Route::post('get-single-product',[App\Http\Controllers\Api\Product::class,'get_single_product']);

Route::post('profile-details',[App\Http\Controllers\Api\User_registration::class,'vendor_profile_details']);

Route::post('user-product',[App\Http\Controllers\User_Api\Product::class,'get_product']);

Route::post('user-register',[App\Http\Controllers\User_Api\User_data::class,'user_register']);

Route::post('user-login',[App\Http\Controllers\User_Api\User_data::class,'user_login']);

Route::post('add-user-cart',[App\Http\Controllers\User_Api\Product::class,'add_to_cart']);

Route::post('count-user-cart',[App\Http\Controllers\User_Api\Product::class,'user_cart_count']);

Route::post('get-single-user-product',[App\Http\Controllers\User_Api\Product::class,'get_single_product']);

Route::post('get-user-cart',[App\Http\Controllers\User_Api\Product::class,'get_user_cart']);

Route::post('delete-user-cart',[App\Http\Controllers\User_Api\Product::class,'cart_delete']);
