<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Image;
use App\Comment;
use App\Like;
use Illuminate\Http\Response;


class ImageController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function create(){
        return view('image.create');
    }

    public function save(Request $request){

        //Validacion
        $validate = $this->validate($request, array(
            'description' => 'required',
            'image_path' => 'required|image'
        ));

        //Recoger datos
        $image_path = $request->file('image_path');
        $description = $request->input('description');

        //Asignar valores al objeto
        $user = \Auth::user();
        $image = new Image();

        $image->user_id = $user->id;
        $image->image_path = null;
        $image->description = $description;

        /*echo '<pre>';
            var_dump($user->id);
        echo '<pre>';*/

        //Subir fichero
        if($image_path){
            $image_path_name = time().$image_path->getClientOriginalName(); //ponerle un nombre
            //agarrar objeto orginal del archivo temporal y mover a la carpeta images del storage
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        }

        $image->save(); //hace el insert en la tabla

        return redirect()->route('home')
                         ->with(array('message' => 'La foto ha sido cargada correctamente!'));
    }

    public function getImage($file_name){
        $file = Storage::disk('images')->get($file_name);
        return new Response($file, 200);
    }

    public function detail($id){
        $image = Image::find($id);

        return view('image.detail', array(
            'image' => $image
        ));
    }

    public function delete($image_id){
        //Conseguir datos del usuario identificado
        $user = \Auth::user();

        //Conseguir objeto de la imagen
        $image = Image::find($image_id);

        //trer comentarios
        $comentarios = Comment::where('image_id', $image_id)->get();
        //traer likes
        $likes = Like::where('image_id', $image_id)->get();

        //Comprobar si el dueño de la imagen es el usuario logueado
        if( $user && $image && ($image->user_id == $user->id) ){

            //Eliminar comentarios
            if($comentarios->count() > 0 ){
                foreach($comentarios as $comment)
                    $comment->delete();
            }

            //Eliminar likes
            if($likes->count() > 0 ){
                foreach($likes as $like)
                    $like->delete();
            }
            //Eliminar ficheros de imagen
            Storage::disk('images')->delete($image->image_path);

            //Eliminar registro de la imagen
            $image->delete();

            return redirect()->route('home')
                            ->with(array('message' => 'La imagen se ha borrado correctamente!'));
        }else{
            return redirect()->route('home')
                            ->with(array('message' => 'La imagen no se ha borrado!'));
        }

    }

    public function edit($image_id){

        //conseguir usuario identificado
        $user = \Auth::user();
        $image = Image::find($image_id);

        if($user && $image && $image->user->id == $user->id){
            return view('image.edit', array(
                'image' => $image
            ));

        }else{
            return redirect()->route('home');
        }
    }

    public function update(Request $request){

        //Validacion
        $validate = $this->validate($request, array(
            'description' => 'required',
            'image_path' => 'image'
        ));

        $image_id = $request->input('image_id');
        $image_path = $request->input('image_path');
        $description = $request->input('description');

        //Conseguir objeto image
        $image = Image::find($image_id);
        $image->description = $description;

        //Subir fichero
        if($image_path){
            $image_path_name = time().$image_path->getClientOriginalName(); //ponerle un nombre
            //agarrar objeto orginal del archivo temporal y mover a la carpeta images del storage
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        }

        $image->update();

        return redirect()->route('image.detail', array('id' =>  $image_id))
                        ->with(array('message' => 'La publicacion ha sido actualizada correctamente!'));
    }

}
