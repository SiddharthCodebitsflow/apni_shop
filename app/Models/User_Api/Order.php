<?php

namespace App\Models\User_Api;
use App\Models\Api\Products;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'local_order';
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function products_relation()
    {
        return $this->hasMany(Products::class, 'id', 'product_id');
    }
}
