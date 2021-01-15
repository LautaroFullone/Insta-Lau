<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showlikes(){
        $user = \Auth::user();

        $likes = Like::where('user_id',$user->id)
                     ->orderBy('id', 'desc')
                    ->simplePaginate(5);
        //        Like::all(); devuelve todo

        return view('likes.images-like', array(
            'likes' => $likes
        ));
    }

    public function like($image_id){
        //Recoger datos del usuario y la imagen
        $user = \Auth::user();

        //Condicion para no duplicar like por usuario
        $cant_likes = Like::where('user_id', $user->id)
                            ->where('image_id', $image_id)
                            ->count();

        if($cant_likes == 0){
            $like = new Like;
            $like->image_id =(int)$image_id;
            $like->user_id = $user->id;

            //Guardar en bd
            $like->save();

            //algo para js
            return response()->json(array(
                'like' => $like
            ));
        }
        else{

            return response()->json(array(
                'message' => "El like ya existe!"
            ));
        }
    }

    public function dislike($image_id){
        //Recoger datos del usuario y la imagen
        $user = \Auth::user();

        //Condicion para no duplicar like por usuario
        $like = Like::where('user_id', $user->id)
                            ->where('image_id', $image_id)
                            ->first();

        if($like){
            //Eliminar like
            $like->delete();

            //algo para js
            return response()->json(array(
                'like' => $like,
                'message' => 'Has dado dislike correctamente!'
            ));
        }
        else{
            return response()->json(array(
                'message' => "El like no existe!"
            ));
        }
    }


}
