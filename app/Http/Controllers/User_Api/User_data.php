<?php

namespace App\Http\Controllers\User_Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use App\Models\User_Api\User_datas;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class User_data extends Controller
{
    public function user_register(Request $request)
    {
        try {
            if ($request->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required'
            ])) {
                $user = new User_datas();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->contact_number = $request->contact;
                $user->password = Hash::make($request->password);
                $user->save();
                return response()->json([
                    'status' => 200,
                    'message' => "register Successfull"
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 422,
                'error' => true,
                'messages' => "Registration Error"
            ]);
        }
    }
    function user_login(Request $request)
    {
        try {
            if (Auth::guard('user_d')->attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::guard('user_d')->user();
                return response()->json([
                    'status' => 200,
                    'id'=>$user->id,
                    'messages'=>"Login Success"
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'status' => 400,
                'messages' => 'You are unauthorised user please register',
                'success' => $e . ''
            ]);
        }
    }
}
