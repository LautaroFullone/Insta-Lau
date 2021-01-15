<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function save(Request $request){

        //Validacion
        $validate = $this->validate($request, array(
            'image_id' => 'integer|required',
            'content' => 'string|required'
        ));

        //Traer los datos
        $user= \Auth::user();
        $image_id = $request->input('image_id');
        $content = $request->input('content');

        //Asignar valores al objeto a guardar
        $comment = new Comment;
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;

        //Guardar en la bd
        $comment->save();

        //Redireccion
        return redirect()->route('image.detail', array('id' => $image_id))
                         ->with( array('message' => 'Comentario publicado correctamente!'));
    }

    public function delete($id){
        //Conseguir datos del usuario identificado
        $user = Auth::user();

        //Conseguir objeto del comentario
        $comment = Comment::find($id);

        //Comprobar si soy el dueño del comment o de la publicacion
        if( $user && ($comment->user_id == $user->id  || $comment->image->user_id == $user->id) ){
            $comment->delete();

            return redirect()->route('image.detail', array('id' => $comment->image->id))
                         ->with( array('message' => 'Comentario eliminado correctamente!'));
        }else{
            return redirect()->route('image.detail', array('id' => $comment->image->id))
                         ->with( array('message' => 'El comentario no ha sido eliminado :('));
        }

    }
}
