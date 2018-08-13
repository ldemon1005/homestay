<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table = 'comments';
    protected $primaryKey = 'comment_id';
    protected $guarded = [];

    public function user(){
    	return $this->belongsTo('App\Models\User','comment_user_id');
    }
    public function homestay(){
    	return $this->belongsTo('App\Models\HomeStay','comment_homestay_id');
    }
}