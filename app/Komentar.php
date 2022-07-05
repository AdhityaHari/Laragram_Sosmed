<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    //
    protected $table = "komentar" ;
    protected $fillable = ["user_id", "post_id", "komentar", "like"];

    public function User(){
        return $this->belongsTo('App\User');
    }

    public function Post(){
        return $this->belongsTo('App\Post');
    }
}
