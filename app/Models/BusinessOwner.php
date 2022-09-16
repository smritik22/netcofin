<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessOwner extends Model
{
    use HasFactory;

    public function businessOwnerTypes(){
        return $this->hasMany(MainUsers::class,'business_type_id','id');
    }
}
