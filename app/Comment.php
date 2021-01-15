<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    //Relacion Many to One / de muchos a uno
    //trae el objeto usuario cuyo ID sea igual al ID_USER del comentario (quien lo publico)
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function image(){
        return $this->belongsTo('App\Image', 'image_id');
    }
}
