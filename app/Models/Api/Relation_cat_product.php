<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relation_cat_product extends Model
{
    use HasFactory;
    protected $table='relation_product_category';
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
