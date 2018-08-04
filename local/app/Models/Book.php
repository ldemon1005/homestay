<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    const TIME_ORDER = 120;
    protected $table = 'books';
    protected $primaryKey = 'book_id';
    protected $guarded = [];

    public function bedroom(){
    	return $this->belongsTo('App\Models\BedRoom','book_bedroom_id');
    }
    public function user(){
    	return $this->belongsTo('App\Models\User','book_user_id');
    }
}