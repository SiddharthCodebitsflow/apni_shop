<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\Api\Attribute;
use App\Models\Api\Register;
use Illuminate\Http\Client\ResponseSequence;
use Symfony\Component\VarDumper\VarDumper;

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
                $att_value_data=implode(",",$att_value_array);
                $att_values = json_encode($att_value_data);
                $att_regitster = new Attribute();
                $att_regitster->vendor_id = $request->session;
                $att_regitster->attribute_name = $request->att_name;
                $att_regitster->attribute_value = $att_values;
                $att_regitster->save();
                return response()->json([
                    'status' => 200,
                    'error' => false,
                    'att_name'=>$request->att_name,
                    'att_value'=>$att_value_data,
                    'messages' => "Attributes Register successfully"
                ]);
            } else {
                throw new Exception("Please Fill correct data");
            }
        } catch (Exception $e) {
            return response()->json([
                'status'=>403,
                'error'=>true,
                'messages'=>"Please Fill Correct Data",
                'message'=>$e
            ]);
        }
    }
    public function get_attribute(Request $request)
    {
        try{
            if($request->validate([
                'user_id' => 'required',
            ])){
                $user_id=$request->user_id;
                $attribute=Attribute::where('vendor_id',$user_id)->get();
                return response()->json([
                    'status'=>200,
                    'error'=>false,
                    'data'=>$attribute
                ]);
            }else{
                throw new Exception("Id Not Found");
            }
        }catch(Exception $e){
            return  response()->json([
                'status'=>403,
                'error'=>true,
                'messages'=>"User Not found",
                'message'=>$e
            ]);
        }
     
    }
}
