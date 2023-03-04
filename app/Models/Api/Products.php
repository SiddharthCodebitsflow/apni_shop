<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table='product';
    protected $hidden = [
        'created_at',
        'updated_at',
        'vendor_id'
    ];
    public function relationship()
    {
        return $this->hasMany(Vendor_cart::class,'product_id');
    }
}
