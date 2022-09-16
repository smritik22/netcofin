<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{

    protected $primaryKey = 'id';
    public $incrementing = false;
    
    use HasFactory;
    protected $fillable = [
        'name', 
        'image', 
        'description', 
        'discount', 
        'price', 
        'category_id', 
        'sub_category_id',
        'business_owner_id',
    ];

    

    public function subcategory(){
        return $this->belongsTo(SubCategory::class,'sub_category_id','id');
    }

    public function mainUsers(){
        return $this->belongsTo(MainUsers::class,'business_owner_id','id');
    }
}
