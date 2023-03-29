<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\Category;
use App\Models\Api\Products;
use App\Models\Api\Relation_cat_product;
use App\Models\Api\Vendor_cart;
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
                'addition_info' => 'required',
                'category_id' => 'required'
            ])) {
                if ($request->file('product_image')->isValid()) {
                    $file = $request->file('product_image');
                    $fileName = 'product/' . $file->getClientOriginalName();
                    // dd($request->attribute);
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
                    $fetch = Products::where('vendor_id', $request->session)->orderBy("id", "desc")->first('id');
                    $cat_arr = explode(',', $request->category_id);
                    foreach ($cat_arr as $cat_id) {
                        $cat_register = new Relation_cat_product();
                        $cat_register->product_id = $fetch->id;
                        $cat_register->category_id = $cat_id;
                        $cat_register->save();
                    }
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
                $fetch = Products::where('vendor_id', '!=', $request->session)->with('relationship')->where('trush_status', 1)->orderBy("id", "desc")->get();
                // $cart_fetch=Vendor_cart::where(['vendor_id',$request->session])->get();
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
    function get_tresh_product(Request $request)
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
    public function delete_product_permanently(Request $request)
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
                    $product->trush_status = -1;
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

    public function add_to_cart(Request $request)
    {
        try {
            if ($request->validate([
                'session' => 'required',
                'product_id' => 'required'
            ])) {
                $cart_register = new Vendor_cart();
                $cart_register->vendor_id = $request->session;
                $cart_register->product_id = $request->product_id;
                $cart_register->save();
                return response()->json([
                    'status' => 200,
                    'error' => false,
                    'message' => 'Add to cart Success'
                ]);
            } else {
                throw new Exception('All data is required required');
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 400,
                'error' => $e . '',
                'message' => 'unavalable product',
                'messages' => $e . ''
            ]);
        }
    }

    public function vendor_cart_product(Request $request)
    {
        try {
            if ($request->validate(['session' => 'required'])) {
                $product_cart = Vendor_cart::where('vendor_id', $request->session)->with('relationship')->get();
                $count = count($product_cart);
                return response()->json([
                    'status' => 200,
                    'error' => false,
                    'count' => $count,
                    'data' => $product_cart,
                ]);
            } else {
                throw new Exception('vendor not login');
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 400,
                'error' => $e . '',
                'message' => 'unavalable product',
                'messages' => $e . ''
            ]);
        }
    }

    public function remove_product_from_cart(Request $request)
    {
        try {
            if ($request->validate(['cart_id' => 'required'])) {
                Vendor_cart::where('id', $request->cart_id)->delete();
                return response()->json([
                    'status' => 200,
                    'error' => false,
                ]);
            } else {
                throw new Exception('id not present');
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 400,
                'error' => $e . '',
                'message' => 'unavalable product',
                'messages' => $e . ''
            ]);
        }
    }

    public function get_single_product(Request $request)
    {
        try {
            if ($request->validate(['product_id' => 'required'])) {
                $product_info = Products::where(['id' => $request->product_id, 'trush_status' => 1])->with('relationship')->get();
                return response()->json([
                    'status' => 200,
                    'error' => false,
                    'data' => $product_info
                ]);
            } else {
                throw new Exception('Unavalable product');
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 400,
                'error' => $e . '',
                'message' => 'unavalable product',
                'messages' => $e . ''
            ]);
        }
    }
}
