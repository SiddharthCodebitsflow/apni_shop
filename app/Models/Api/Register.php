<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    use HasFactory;
    protected $table='user';
    protected $fillable=[
        'Name',
        'Email',
        'Contact',
        'Shop_id',
        'Address',
        'shop_image',
        'password'
    ];

    protected $hidden = [
        'remember_token',
    ];

}
