<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Api\Relation_cat_product;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category';
    protected $fillable = [
        'cat_name',
        'cat_descreption',
        'vendor_id'
    ];
    
    public function relationship()
    {
        return $this->hasMany(Relation_cat_product::class,'category_id');
    }

    public function counts()
    {
        return $this->table;
    }
    protected $hidden = [
        'created_at',
        'updated_at',
        'vendor_id'
    ];
}
