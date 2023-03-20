<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Api\Vendor_attribute;

class RedirectSession extends Controller
{
    public function index()
    {
        if (session('user_id')) {
            return redirect('home');
        } else {
            return view('index');
        }
    }
    public function session(Request $request)
    {
        session(['user_id' => $request->user_id]);
        if (session('user_id')) {
            return  response()->json([
                'status' => 200,
            ]);
        } else {
            return  response()->json([
                'status' => 400,
            ]);
        }
    }
    public function home()
    {
        return view('vendor/home');
    }
    public function vendor_register()
    {
        if (session('user_id')) {
            return redirect('home');
        } else {
            return view('vendor/vendor_register');
        }
    }
    public function login()
    {
        if (session('user_id')) {
            return redirect('home');
        } else {
            return view('vendor/vendor_login');
        }
    }
    public function forget_password()
    {
        if (session('user_id')) {
            return redirect('home');
        } else {
            return view('vendor/forget_password');
        }
    }

    public function logout()
    {
        session()->forget('user_id');
        if (session('user_id')) {
            return redirect('home');
        } else {
            return redirect('login');
        }
    }

    // public function add_new_product()
    // {
    //     return view('vendor/add_new_product');
    // }
    public function attributes()
    {
        return view('vendor/attributes');
    }
    public function update_attribute($id)
    {
        return view('vendor/edit_attributes')->with('att_id',$id);
    }
    public function category()
    {
        return view('vendor/category');
    }
    public function update_category($id)
    {
       return view('vendor/edit_category')->with('cat_id',$id);
    }
    public function vendor_all_product()
    {
        return view('vendor/vendor_all_product');
    }
    public function product_tresh()
    {
        return view('vendor/product_tresh');
    }
    public function add_to_cart()
    {
        return view('vendor/add_to_cart');
    }
    public function about_product($id)
    {
        return view('vendor/about_product')->with('product_id',$id);
    }
}
