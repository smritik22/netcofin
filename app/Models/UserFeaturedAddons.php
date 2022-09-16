<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFeaturedAddons extends Model
{
    use HasFactory;

    protected $table = 'user_featured_addons';

    protected $fillable = [
        'id',
        'user_id',
        'plan_id',
        'feature_id',
        'transaction_id',
        'start_date',
        'end_date',
        'duration_value',
        'duration_type',
        'price',
        'created_at',
        'updated_at',
    ];

    public function featuredAddons() {
        return $this->belongsTo(FeaturedAddons::class, 'feature_id', 'id');
    }
}
