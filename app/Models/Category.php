<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'image', 
        'tax',
        'status',
        'business_owner_id', 
    ];

    public function mainUser(){
        return $this->hasMany(Category::class,'business_owner_id','id');
        // return $this->belongsTo(MainUsers::class,'business_owner_id','id');
    }

    public function subcategory(){
        return $this->hasMany(SubCategory::class,'category_id','id');
    }

    public function modifiers(){
        return $this->hasMany(Modifiers::class,'category_id','id');
    }
}
