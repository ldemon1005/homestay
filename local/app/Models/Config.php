<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = "configs";
    protected $fillable = ['value'];
    public $timestamps = false;

    public function getBanner()
    {
        return $this->where('name','banner')->first();
    }

    public function getInfo()
    {
        return $this->where('name','info')->first();
    }

    public function getTerm()
    {
        return $this->where('name','term')->first();
    }

    public function getPolicy()
    {
        return $this->where('name','policy')->first();
    }

}
