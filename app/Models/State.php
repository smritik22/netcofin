<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';

	protected $fillable = [
        'name',
        'country_id',
        'parent_id',
        'status'
    ];

    

    public function city(){
        return $this->hasMany(City::class,'state_id','id');
    }

    public function country(){
        return $this->belongsTo(Country::class,'country_id','id');
    }
}
