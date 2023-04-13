<?php

namespace App\Models\User_Api;

use App\Models\Api\Products;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_cart extends Model
{
    use HasFactory;
    protected $table = 'user_cart';
    protected $hidden = [
        'created_at',
        'updated_at',
        'vendor_id'
    ];
    public function products_relation()
    {
        return $this->hasMany(Products::class, 'id','product_id');
    }
}
