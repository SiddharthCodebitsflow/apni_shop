<?php

namespace App\Models\User_Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Products extends Model
{
    use HasFactory;
    protected $table='product';
    protected $hidden = [
        'created_at',
        'updated_at',
        'vendor_id'
    ];
}
