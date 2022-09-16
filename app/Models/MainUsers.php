<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;


class MainUsers extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $table = "users";
    protected $guard = 'web';
    
    protected $fillable = [
        'full_name', 
        'email', 
        'country_code', 
        'mobile_number',
        'password',
        'otp',
        'is_otp_varified',
        'otp_expire_time',
        'remember_token',
        'device_type',
        'device_token',
        'device_id',
        'user_type',
        'agent_type',
        'agent_joined_date',
        'profile_image',
        'about_user',
        'user_short_address',
        'created_by', 
        'updated_by',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

     /**
     * The attributes that should be cast.
     *
     * @var array
     */
   

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
  

    public function properties(){
        return $this->hasMany(Property::class,'agent_id','id');
    }

    public function subscriptionDetails(){
        return $this->hasMany(UserSubscription::class,'user_id','id');
    }
  

    public function BusinessOwnerType(){
        return $this->belongsTo(BusinessOwnerType::class,'business_type_id','id');
    }

    public function category(){
        return $this->belongsTo(MainUsers::class,'business_owner_id','id');
    }
}
