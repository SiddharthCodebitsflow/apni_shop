<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\Products;
use Exception;
use Illuminate\Http\Request;
use Image;

class Product extends Controller
{
    public function insert_product(Request $request)
    {
        try {
            if ($request->validate([
                'session' => 'required',
                'product_name' => 'required',
                'vendor_price' => 'required',
                'regular_price' => 'required',
                'sale_price' => 'required',
                'inventory' => 'required',
                'shipping' => 'required',
                'attribute' => 'required',
                'category' => 'required',
                'addition_info' => 'required'
            ])) {
                if ($request->file('product_image')->isValid()) {
                    $file = $request->file('product_image');
                    $fileName = 'product/' . $file->getClientOriginalName();
                    $file->move(public_path('product/'), $file->getClientOriginalName());
                    $register = new Products();
                    $register->product_name = $request->product_name;
                    $register->vendor_id = $request->session;
                    $register->vendor_price = $request->vendor_price;
                    $register->regular_price = $request->regular_price;
                    $register->sale_price = $request->sale_price;
                    $register->product_image = $fileName;
                    $register->inventory = $request->inventory;
                    $register->shipping = $request->shipping;
                    $register->attribute = $request->attribute;
                    $register->category = $request->category;
                    $register->addition_info = $request->addition_info;
                    $register->trush_status = 1;
                    $register->save();
                    return response()->json([
                        'status' => 200,
                        'message' => 'product has been saved'
                    ]);
                } else {
                    return response()->json([
                        'status' => 400,
                        'message' => 'image is not valid'
                    ]);
                }
            } else {
                throw new Exception('data not valid');
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 400,
                'message' => 'data is not valid',
                'messages' => $e . ''
            ]);
        }
    }

    function get_all_product_except_current_vendor(Request $request)
    {
        try {
            if ($request->validate(['session' => 'required'])) {
                $fetch = Products::where('vendor_id', '!=', $request->session)->orderBy("id", "desc")->get();
                return response()->json([
                    'status' => 200,
                    'data' => $fetch
                ]);
            } else {
                throw new Exception('session is not seted');
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 404,
                'message' => 'Data is not found',
                'error' => $e . ''
            ]);
        }
    }
    function get_all_product_of_current_vendor(Request $request)
    {
        try {
            if ($request->validate(['session' => 'required'])) {
                $fetch = Products::where('vendor_id', $request->session)->where('trush_status', 1)->orderBy("id", "desc")->get();
                return response()->json([
                    'status' => 200,
                    'data' => $fetch
                ]);
            } else {
                throw new Exception('session is not seted');
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 404,
                'message' => 'Data is not found',
                'error' => $e . ''
            ]);
        }
    }
    function get_trush_product(Request $request)
    {
        try {
            if ($request->validate(['session' => 'required'])) {
                $fetch = Products::where('vendor_id', $request->session)->where('trush_status', '==', 0)->orderBy("id", "desc")->get(['id', 'product_name', 'product_image']);
                return response()->json([
                    'status' => 200,
                    'data' => $fetch
                ]);
            } else {
                throw new Exception('session is not seted');
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 404,
                'message' => 'Data is not found',
                'error' => $e . ''
            ]);
        }
    }

    public function recover_product(Request $request)
    {
        try {
            if ($request->validate(['product_id' => 'required'])) {
                $product = Products::where('id', $request->product_id)->first();
                if (empty($product)) {
                    return response()->json([
                        'status' => 404,
                        'error' => true,
                        'message' => 'Please fill correct id'
                    ]);
                } else {
                    $product->trush_status = 1;
                    $product->save();
                    return response()->json([
                        'status' => 200,
                        'error' => false,
                        'message' => 'Recover Success'
                    ]);
                }
            } else {
                throw new Exception('product id is required');
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 400,
                'error' => $e . '',
                'message' => 'unavalable product'
            ]);
        }
    }
    public function delete_product(Request $request)
    {
        try {
            if ($request->validate(['product_id' => 'required'])) {
                $product = Products::where('id', $request->product_id)->first();
                if (empty($product)) {
                    return response()->json([
                        'status' => 404,
                        'error' => true,
                        'message' => 'Please fill correct id'
                    ]);
                } else {
                    $product->trush_status = 0;
                    $product->save();
                    return response()->json([
                        'status' => 200,
                        'error' => false,
                        'message' => 'Recover Success'
                    ]);
                }
            } else {
                throw new Exception('product id is required');
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 400,
                'error' => $e . '',
                'message' => 'unavalable product'
            ]);
        }
    }
}
