<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeStay extends Model
{
    //
    protected $table = 'homestay';
    protected $primaryKey = 'homestay_id';
    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\Models\Host','homestay_user_id');
    }
    public function bedroom(){
    	return $this->hasMany('App\Models\BedRoom','bedroom_homestay_id');
    }
    public function homestayimage(){
        return $this->hasMany('App\Models\HomestayImage','homestay_image_homestay_id');
    }
    public function comment(){
        return $this->hasMany('App\Models\Comment','comment_homestay_id');
    }
}
