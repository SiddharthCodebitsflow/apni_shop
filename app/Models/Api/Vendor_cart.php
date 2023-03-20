<?php

namespace App\Models\Api;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor_cart extends Model
{
    use HasFactory;
    protected $table='vendor_cart';
    public function relationship()
    {
        return $this->hasOne(Products::class,'id','product_id');
    }
}
