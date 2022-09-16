<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class BusinessOwnerType extends Model
{
    use HasFactory;
    public function businessOwnerType(){
        return $this->hasMany(MainUsers::class,'business_type_id','id');
    }
}
