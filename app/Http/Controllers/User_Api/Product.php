<?php

namespace App\Http\Controllers\User_Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User_Api\User_Products;
use Exception;

class Product extends Controller
{
    function get_product()
    {
        try {
            $fetch = User_Products::orderBy("id", "desc")->get();
            return response()->json([
                'status' => 200,
                'data' => $fetch
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 404,
                'message' => 'Data is not found',
                'error' => $e . ''
            ]);
        }
    }
}
