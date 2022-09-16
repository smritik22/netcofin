<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

	protected $fillable = [
        'name',
        'language_id',
        'parent_id',
        'image',
        'currency_code',
        'currency_decimal_point',
        // 'currency_sign',
        'country_code',
        // 'country_code_txt',
        'currency_value',
        // 'tax_perc',
        // 'fj_currency_value',
        // 'cur_status',
        'status'
    ];

    

    public function childdata()
    {
        return $this->hasMany('App\Models\Country','parent_id','id');
    }

    public function state(){
        return $this->hasMany(State::class,'country_id','id');
    }

    public function city(){
        return $this->hasMany(City::class,'country_id','id');
    }
}
