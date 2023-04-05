<?php

namespace App\Models\User_Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class User_datas extends Authenticatable
{
    use HasFactory, HasApiTokens;
    protected $table='user_register';
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
