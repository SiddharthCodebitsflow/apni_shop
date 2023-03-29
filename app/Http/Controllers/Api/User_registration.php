<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\Register;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class User_registration extends Controller
{
    function vendor_register(Request $request)
    {
        try {
            if ($request->validate([
                'Name' => 'required', 'Email' => 'required', 'Contact' => 'required',
                'Shop_id' => 'required', 'Address' => 'required', 'password' => 'required',
                'Upi'=>'required'
            ])) {
                if ($request->file('profile')->isValid()) {
                    $file = $request->file('profile');
                    $fileName = 'uploads/' . $file->getClientOriginalName();
                    $file->move(public_path('uploads/'), $file->getClientOriginalName());
                    $register = new Register();
                    $register->name = $request->Name;
                    $register->email = $request->Email;
                    $register->contact = $request->Contact;
                    $register->shop_id = $request->Shop_id;
                    $register->address = $request->Address;
                    $register->shop_image = $fileName;
                    $register->password = Hash::make($request->password);
                    $register->upi=$request->Upi;
                    $register->status = 0;
                    $register->save();
                    return response()->json([
                        'status' => 200,
                        'error' => false,
                        'messages' => "Register Successfull"
                    ]);
                } else {
                    return response()->json([
                        'status' => 422,
                        'error' => true,
                        'messages' => "Registration Error"
                    ]);
                }
            } else {
                throw new Exception("Validation Error");
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 422,
                'error' => true,
                'messages' => $e . ''
            ]);
        }
    }


    function vendor_login(Request $request)
    {
        try {
            session()->regenerate();
            if (Auth::attempt(['email' => $request->Email, 'password' => $request->password, 'shop_id' => $request->Shop_id])) {
                $user = Auth::user();
                if ($user->status == 0) {
                    return response()->json([
                        'status' => 401,
                        'error' => true,
                        'messages' => "Your shop is not verified please wait for sometime"
                    ]);
                } else if ($user->status == 1) {
                    return response()->json([

                        'user_name' => $user->name,
                        'user_id' => $user->id,
                        'status' => '200',
                        'messages' => 'User login successfully.',
                    ]);
                }
            } else {
                throw new Exception("Unauthorised User");
            }
        } catch (Exception $e) {
            session()->regenerate();
            return response()->json([
                'error' => true,
                'status' => 400,
                'messages' => 'You are unauthorised vendor please register your shop',
                'success' => $e . ''
            ]);
        }
    }

    public function forget_password(Request $request)
    {
        try {
            if ($request->validate([
                'Email' => 'required',
                'Contact' => 'required',
                'Shop_id' => 'required',
                'password' => 'required',
            ])) {
                $user = User::where([
                    'email' => $request->Email,
                    'shop_id' => $request->Shop_id,
                    'contact' => $request->Contact
                ])
                    ->first();
                if (empty($user)) {
                    return response()->json([
                        'status' => 401,
                        'message' => 'You are unauthorised vendor please register your shop',
                    ]);
                } else {
                    $user->password = Hash::make($request->password);
                    $user->updated_at = now();
                    $user->save();
                    return response()->json([
                        'status' => 200,
                        'message' => 'your password has been updated please login your shop'
                    ]);
                }
            } else {
                throw new Exception("Please fill correct information");
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'status' => 400,
                'message' => 'The given data was invalid',
                'success' => $e . ''
            ]);
        }
    }

    public function vendor_profile_details(Request $request)
    {
        try {
            if ($request->validate([
                'session_id' => 'required'
            ])) {
                $user = User::find($request->session_id);
                return response()->json([
                    'error' => false,
                    'status' => 200,
                    'data' => $user,
                ]);
            } else {
                throw new Exception('session is required');
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'status' => 400,
                'message' => 'The given data was invalid',
                'success' => $e . ''
            ]);
        }
    }
}
