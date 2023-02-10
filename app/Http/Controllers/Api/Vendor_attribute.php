<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\Api\Attribute;

class Vendor_attribute extends Controller
{
    public function attribute(Request $request)
    {
        try {
            if ($request->validate([
                'session' => 'required',
                'att_name' => 'required',
                'att_value' => 'required'
            ])) {
                $att_value_array = explode('|', $request->att_value);
                $att_value_data = implode(",", $att_value_array);
                $att_values = json_encode($att_value_data);
                $att_value = trim($att_values, '"');
                $att_regitster = new Attribute();
                $att_regitster->vendor_id = $request->session;
                $att_regitster->attribute_name = $request->att_name;
                $att_regitster->attribute_value = $att_value;
                $att_regitster->save();
                $attribute = Attribute::where('vendor_id', $request->session)->orderByDesc('id')->first();
                return response()->json([
                    'status' => 200,
                    'error' => false,
                    'att_name' => $attribute->attribute_name,
                    'att_value' => $attribute->attribute_value,
                    'att_id' => $attribute->id,
                    'messages' => "Attributes Register successfully"
                ]);
            } else {
                throw new Exception("Please Fill correct data");
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 403,
                'error' => true,
                'messages' => "Please Fill Correct Data",
                'message' => $e
            ]);
        }
    }
    public function get_attribute(Request $request)
    {
        try {
            if ($request->validate([
                'user_id' => 'required',
            ])) {
                $user_id = $request->user_id;
                $attribute = Attribute::where('vendor_id', $user_id)->get();
                return response()->json([
                    'status' => 200,
                    'error' => false,
                    'data' => $attribute
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

    public function delete_att(Request $request)
    {
        try {
            if ($request->validate([
                'att_id' => 'required'
            ])) {
                $id = $request->att_id;
                $att_delete = Attribute::where('id', $id)->delete();
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

    public function get_single_att(Request $request)
    {
        try {
            if ($request->validate([
                'att_id' => 'required'
            ])) {
                $id = $request->att_id;
                $att_data = Attribute::where('id', $id)->first();
                return response()->json([
                    'status' => 200,
                    'error' => false,
                    'att_name' => $att_data->attribute_name,
                    'att_value' => $att_data->attribute_value
                ]);
            } else {
                throw new Exception("Id Not Found");
            }
        } catch (Exception $e) {
            return  response()->json([
                'status' => 403,
                'error' => true,
                'messages' => "User Not found",
                'message' => $e . ''
            ]);
        }
    }

    public function att_update(Request $request)
    {
        try {
            if ($request->validate([
                'att_id' => 'required',
                'att_name' => 'required',
                'att_value' => 'required'
            ])) {
                $att_val = Attribute::where('id', $request->att_id)->first();
                if (empty($att_val)) {
                    return response()->json([
                        'status' => 404,
                        'error' => true,
                        'message' => 'Please fill correct id'
                    ]);
                } else {
                    $att_val->attribute_name = $request->att_name;
                    $att_val->attribute_value = $request->att_value;
                    $att_val->save();
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
                'message' => 'All fieldare required',
                'messages' => $e . ''
            ]);
        }
    }
}
