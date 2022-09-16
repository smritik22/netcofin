<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    
    protected $table = 'email_templates';
    protected $primaryKey = 'id';

    protected $fillable = [
        'language_id', 'parent_id', 'title', 'subject', 'content', 'status' 
    ];

    public function childdata()
    {
        return $this->hasMany('App\Models\EmailTemplate', 'parent_id', 'id');
    }

}
