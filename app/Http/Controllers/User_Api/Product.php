<?php

namespace App\Http\Controllers\User_Api;

use App\Http\Controllers\Controller;
use App\Models\User_Api\User_cart;
use Illuminate\Http\Request;
use App\Models\User_Api\User_Products;
use Exception;
use App\Models\Api\Products;
use App\Models\User_Api\Order;

class Product extends Controller
{
    function get_product()
    {
        try {
            $fetch = User_Products::where(['trush_status' => 1])->orderBy("id", "desc")->get();
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
    public function add_to_cart(Request $request)
    {
        try {
            if ($request->validate([
                'product_id' => 'required',
                'user_id' => 'required',
                'qty' => 'required'
            ])) {
                $before_cart = User_cart::where([
                    'product_id' => $request->product_id,
                    'user_id' => $request->user_id
                ])->first();
                if ($before_cart) {
                    $before_cart->qty = $request->qty;
                    $before_cart->updated_at = now();
                    $before_cart->save();
                    return response()->json([
                        'status' => 200,
                        'message' => 'cart Success',
                        'cart_status' => 0
                    ]);
                } else {
                    $add_cart = new User_cart();
                    $add_cart->user_id = $request->user_id;
                    $add_cart->product_id = $request->product_id;
                    $add_cart->qty = $request->qty;
                    $add_cart->save();
                    return response()->json([
                        'status' => 200,
                        'message' => 'cart Success',
                        'cart_status' => 1
                    ]);
                }
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 421,
                'message' => $e . ''
            ]);
        }
    }

    public function user_cart_count(Request $request)
    {
        try {
            if ($request->validate(['user_session' => 'required'])) {
                $product_cart = User_cart::where('user_id', $request->user_session)->get();
                $count = count($product_cart);
                return response()->json([
                    'status' => 200,
                    'error' => false,
                    'count' => $count,
                ]);
            } else {
                throw new Exception('vendor not login');
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 400,
                'error' => $e . '',
            ]);
        }
    }
    public function get_single_product(Request $request)
    {
        try {
            if ($request->validate(['product_id' => 'required'])) {
                $product_info = Products::where(['id' => $request->product_id, 'trush_status' => 1])->with('user_relationship')->get();
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
                'message' => 'unavailable product',
                'messages' => $e . ''
            ]);
        }
    }

    public function get_user_cart(Request $request)
    {
        try {
            if ($request->validate([
                'user_id' => 'required'
            ])) {
                $cart_data = User_cart::where(['user_id' => $request->user_id])->with('products_relation')->get();
                if ($cart_data) {
                    return response()->json([
                        'status' => 200,
                        'error' => false,
                        'data' => $cart_data
                    ]);
                } else {
                    return response()->json([
                        'status' => 404,
                        'error' => false,
                        'message' => 'Not have data'
                    ]);
                }
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 400,
                'error' => true,
            ]);
        }
    }

    public function cart_delete(Request $request)
    {
        try {
            if ($request->validate([
                'cart_id' => 'required'
            ])) {
                $delete = User_cart::where(['id' => $request->cart_id])->delete();
                return response()->json([
                    'status' => 200,
                    'error' => false,
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 400,
                'error' => true,
            ]);
        }
    }

    public function local_order(Request $request)
    {
        try {
            if ($request->validate([
                'user_id' => 'required',
                'name' => 'required',
                'email' => 'required',
                'contact' => 'required',
                'address' => 'required',
                'postcode' => 'required',
                'country' => 'required',
                'addition_information' => 'required',
                // 'attribute' => 'required',
                'qty' => 'required',
                'product_id' => 'required',
                'total_price' => 'required',
                'payment_type' => 'required'
            ])) {
                $order_register = new Order();
                $order_register->user_id = $request->user_id;
                $order_register->name = $request->name;
                $order_register->email = $request->email;
                $order_register->contact = $request->contact;
                $order_register->address = $request->address;
                $order_register->postcode = $request->postcode;
                $order_register->country = $request->country;
                $order_register->product_id = $request->product_id;
                $order_register->attribute = $request->attribute;
                $order_register->total_price = $request->total_price;
                $order_register->qty = $request->qty;
                $order_register->Payment_type = $request->payment_type;
                $order_register->addition_information = $request->addition_information;
                $order_register->confirm_status = 0;
                $order_register->save();
                return response()->json([
                    'status' => 200,
                    'error' => false,
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 400,
                'error' => true,
                'message' => $e . ''
            ]);
        }
    }

    public function get_checkout(Request $request)
    {
        try {
            if ($request->validate(['user_id' => 'required'])) {
                $checkout_data = Order::where(['user_id' => $request->user_id])->with('products_relation')->get();
                return response()->json([
                    'status' => 200,
                    'error' => false,
                    'data' => $checkout_data
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 400,
                'error' => true,
                'message' => $e . ''
            ]);
        }
    }


}
