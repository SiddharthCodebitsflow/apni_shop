<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

    public function add_new_product()
    {
        return view('vendor/add_new_product');
    }
    public function attributes(Request $request)
    {
        $response = Http::post('http://127.0.0.1:8003/api/get-attribute', [
            'user_id' => session('user_id'),
        ]);
        dd($response);
        return view('vendor/attributes');
    }
}
