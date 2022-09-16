<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'image', 
        'description', 
        'discount', 
        'price', 
        'category_id', 
        'tax',
    ];

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function items(){
        return $this->belongsTo(Items::class,'sub_category_id','id');
    }
}
