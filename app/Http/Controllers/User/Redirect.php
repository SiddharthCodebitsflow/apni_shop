<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class Redirect extends Controller
{
    public function home()
    {
        return view('user/user_home');
    }
    public function product_about($id)
    {
        return view('user/user_about_product')->with('product_id', $id);
    }

    public function user_logout()
    {
        session()->forget('login_id');
        if (session('login_id')) {
            return redirect('user-home');
        } else {
            return redirect('user-home');
        }
    }

    public function user_register()
    {
        if (session('login_id')) {
            return view('user/user_home');
        } else {
            return view('user/user_register');
        }
    }

    public function user_login()
    {
        if (session('login_id')) {
            return view('user/user_home');
        } else {
            return view('user/user_login');
        }
    }

    public function user_session(Request $request)
    {
        session(['login_id' => $request->user_id]);
        if (session('login_id')) {
            return  response()->json([
                'status' => 200,
            ]);
        } else {
            return  response()->json([
                'status' => 400,
            ]);
        }
    }

    // public function add_to_cart_cookie(Request $request, $id, $qty)
    // {
    //     $minutes = 24 * 60;
    //     $data = [
    //         "product_id" => $id,
    //         "qty" => $qty
    //     ];
    //     $response = new Response('Hello World');
    //     $message = $response->cookie('cart', json_encode($data), $minutes);
    //     return redirect('user-about-product/5')->withCookie('cart', json_encode($data));
    // }


}
