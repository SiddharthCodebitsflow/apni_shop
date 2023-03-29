<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Redirect extends Controller
{
    public function home()
    {
        return view('user/user_home');
    }
    public function product_about($id)
    {
        return view('user/user_about_product')->with('product_id',$id);
    }
}
