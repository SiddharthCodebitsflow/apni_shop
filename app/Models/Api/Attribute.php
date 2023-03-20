<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    protected $table='attribute';
    protected $fillable=[
        'vendor_id',
        'attribute_name',
        'attribute_value',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'vendor_id'
    ];
}
