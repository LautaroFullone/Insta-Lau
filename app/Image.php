<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    //Relacion One to Many / de uno a muchos
    //trae todos los comentarios cuyo ID sea igual al ID de la imagen
    public function comments(){
        return $this->hasMany('App\Comment')->orderBy('id', 'desc');
    }

    //Relacion One to Many / de uno a muchos
    //trae todos los likes cuyo ID sea igual al ID de la imagen
    public function likes(){
        return $this->hasMany('App\Like');
    }

    //Relacion Many to One / de muchos a uno
    //trae el objeto usuario cuyo ID sea igual al ID_USER de la imagen (quien la publico)
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

}
