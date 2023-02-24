<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\Category;
use Illuminate\Http\Request;
use Exception;

class Vendor_category extends Controller
{
    public function insert_catgory(Request $request)
    {
        try {
            if ($request->validate([
                'session' => 'required',
                'cat_name' => 'required',
                'cat_descreption' => 'required'
            ])) {
                $register = new Category();
                $register->cat_name = $request->cat_name;
                $register->cat_descreption = $request->cat_descreption;
                $register->vendor_id = $request->session;
                $register->save();
                $category = Category::where('vendor_id', $request->session)->orderByDesc('id')->first();
                return response()->json([
                    'status' => 200,
                    'error' => false,
                    'cat_id' => $category->id,
                    'cat_name' => $category->cat_name,
                    'cat_descreption' => $category->cat_descreption,
                    'message' => 'Category has been saved'
                ]);
            } else {
                throw new Exception("please fill correct information");
            }
        } catch (Exception $e) {
            return  response()->json([
                'status' => 403,
                'error' => true,
                'message' => "please fill correct information",
                'messages' => $e
            ]);
        }
    }

    public function get_category(Request $request)
    {
        try {
            if ($request->validate([
                'session' => 'required'
            ])) {
                $category = Category::where('vendor_id', $request->session)->get();
                return response()->json([
                    'status' => 200,
                    'error' => false,
                    'data'=>$category,
                ]);
            } else {
                throw new Exception("You are not Login User");
            }
        } catch (Exception $e) {
            return  response()->json([
                'status' => 403,
                'error' => true,
                'message' => "please fill correct information",
                'messages' => $e.''
            ]);
        }
    }

    public function delete_category(Request $request)
    {
        try {
            if ($request->validate([
                'att_id' => 'required'
            ])) {
                $id = $request->att_id;
                $att_delete = Category::where('id', $id)->delete();
                return response()->json([
                    'status' => 200,
                    'error' => false,
                ]);
            } else {
                throw new Exception("Id Not Found");
            }
        } catch (Exception $e) {
            return  response()->json([
                'status' => 403,
                'error' => true,
                'messages' => "User Not found",
                'message' => $e
            ]);
        }
    }
    
    public function get_single_category(Request $request)
    {
        try {
            if ($request->validate([
                'cat_id' => 'required'
            ])) {
                 
                $cat_data = Category::where('id', $request->cat_id)->first();
                return response()->json([
                    'status' => 200,
                    'error' => false,
                    'cat_name' => $cat_data->cat_name,
                    'cat_descreption' => $cat_data->cat_descreption
                ]);
            } else {
                throw new Exception("Id Not Found");
            }
        } catch (Exception $e) {
            return  response()->json([
                'status' => 403,
                'error' => true,
                'messages' => "Category Not found",
                'message' => $e . ''
            ]);
        }
    }

    public function category_update(Request $request)
    {
        try {
            if ($request->validate([
                'cat_id' => 'required',
                'cat_name' => 'required',
                'cat_descreption' => 'required'
            ])) {
                $cat_val = Category::where('id', $request->cat_id)->first();
                if (empty($cat_val)) {
                    return response()->json([
                        'status' => 404,
                        'error' => true,
                        'message' => 'Please fill correct id'
                    ]);
                } else {
                    $cat_val->cat_name = $request->cat_name;
                    $cat_val->cat_descreption = $request->cat_descreption;
                    $cat_val->save();
                    return response()->json([
                        'status' => 200,
                        'error' => false,
                        'message' => 'Attributes has been updated'
                    ]);
                }
            } else {
                throw new Exception('All field are required');
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'status' => 404,
                'message' => 'All field required',
                'messages' => $e . ''
            ]);
        }
    }
}
