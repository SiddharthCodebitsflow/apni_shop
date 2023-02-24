<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table='category';
    protected $fillable=[
        'cat_name',
        'cat_descreption',
        'vendor_id'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'vendor_id'
    ];
}
