<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\Attribute;
use Exception;
use App\Models\Api\Category;

class AddProduct extends Controller
{
    public function add_new_product()
    {
        try {
            if (session('user_id')) {
                $user_id = session('user_id');
                $attribute = Attribute::where('vendor_id', $user_id)->get();
                $category = Category::where('vendor_id', $user_id)->get();
                $cat_array = json_decode($category);
                $att_array = json_decode($attribute);
                $temp_array = [];
                // foreach ($att_array as  $key => $value) {
                //     $temp_array[$key]['id'] = $value->id;
                //     $temp_array[$key]['att_name'] = $value->attribute_name;
                //     $temp_array[$key]['att_value'] = explode(',', $value->attribute_value);
                // }
                // dd($temp_array);
                return view('vendor/add_new_product')->with(array(
                    'attribute' => $att_array,
                    'category' => $cat_array
                ));
            } else {
                throw new Exception("Id Not Found");
            }
        } catch (Exception $e) {
            return view('vendor/add_new_proudct');
        }
    }
}
