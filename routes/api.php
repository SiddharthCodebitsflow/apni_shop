<?php

use Illuminate\Http\Request;
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