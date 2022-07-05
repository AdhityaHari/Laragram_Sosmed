<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $table = "post";
    protected $fillable = ["gambar", "caption", "user_id"];

    public function User()
    {
        return $this->belongsTo('App\User');
    }

    public function Comment(){
        return $this->hasMany('App\Komentar');
    }
}
