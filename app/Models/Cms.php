<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cms extends Model {

	protected $table = 'cms';

	protected $fillable = [
        'page_name', 'description' , 'language_id' , 'parentid' , 'meta_title', 'meta_description', 'url', 'status' , 'create_by' , 'update_by', 'other_title', 
        'other_description', 'other_image', 'image','other_highlight','other_title1','other_description1','other_image1','other_highlight1','other_title2','other_description2','other_image2','other_highlight2',
    ];

    public function childdata()
    {
        return $this->hasMany('App\Models\Cms','parentid','id');
    }
}