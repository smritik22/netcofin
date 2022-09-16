<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';

	protected $fillable = [
        'trans_no',
        'property_id',
        'subscription_plan_id',
        'subscription_type',
        'agent_id',
        'amount',
        'property_price',
        'area_id',
        'status',
    ];

    // protected $visible = [
    //     'trans_no',
    //     'property_id',
    //     'subscription_plan_id',
    //     'subscription_type',
    //     'agent_id',
    //     'amount',
    //     'property_price',
    //     'area_id',
    //     'status',
    // ];

    public function propertyDetails(){
        return $this->belongsTo(Property::class,'id','property_id');
    }

    public function agentDetails(){
        return $this->belongsTo(MainUsers::class,'agent_id','id');
    }
}
