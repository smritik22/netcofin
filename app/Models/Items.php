<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'image', 
        'description', 
        'price', 
        'category_id', 
        'business_owner_id', 
        'sub_category_id',
        'item_id',
        'item_preparing_time',
        'status'
    ];

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
