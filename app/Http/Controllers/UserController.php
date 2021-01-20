<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use App\User;


class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /*public function index($search = null){
        if(!empty($search)){

            $users = User::where('nick', 'LIKE', '%'.$search.'%')
                           ->orWhere('name', 'LIKE', '%'.$search.'%')
                           ->orWhere('surname', 'LIKE', '%'.$search.'%')
                           ->orderBy('id', 'desc')
                           ->paginate(8);


        }else{
            $users = User::orderBy('id', 'desc')->paginate(8);
        }

        return view('user.index', array(
            'users' => $users
        ));
    }*/

    public function index(){

        $users = User::orderBy('id', 'desc')->paginate(10);

        return view('user.index', array(
            'users' => $users
        ));
    }


    public function search(Request $request){

        $search = $request->input('searching');

        $users = User::where('nick', 'LIKE', '%'.$search.'%')
                           ->orWhere('name', 'LIKE', '%'.$search.'%')
                           ->orWhere('surname', 'LIKE', '%'.$search.'%')
                           ->orderBy('id', 'desc')
                           ->paginate(8);

        return view('user.index', array(
            'users' => $users
        ));
    }


    public function config(){
        return view('user.config');
    }

    public function update(Request $request){

        //conseguir usuario identificado
        $user = Auth::user();

        //valida si los datos son correcto desde la request
        $id = $user->id;

        $validate = $this->validate($request, array(
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nick' => ['required', 'string', 'max:255',"unique:users,nick,$id"],            //excepcion para que puda coincidir con
            'email' => ['required', 'string', 'email', 'max:255', "unique:users,email,$id"] //el mismo usuario sobre el que se esta trabajando
        ));

        //Recoger datos del formulario
        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');

        //Asignar nuevos valores al objeto User
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;

        // >>>>> SUBIR IMAGEN A BD <<<<<

        //Recoger imagen
        $image_path = $request->file('image_path');

        if($image_path){
            //Poner nombre unico
            $image_path_name = time().$image_path->getClientOriginalName(); //ponerle un nombre

            // Guardar en la carpeta storage (storage/app/users)
            Storage::disk('users')->put($image_path_name, File::get($image_path)); //nombre y foto (objeto)

            //Setear el nombre de la imagen en el objeto (atributo de la tabla user)
            $user->image = $image_path_name;
        }

        //Ejecutar consulta y cambios en la BD
        $user->update();

        return redirect()->route('user.config')
                         ->with(array('message' => 'Usuario actualizado correctamente'));
    }

    //saca la imagen de la carpeta storage, con capa extra de seguridad,
    //no se puede sacar imagen sin estar identificado
    public function getImage($file_name){
        $file = Storage::disk('users')->get($file_name);
        return new Response($file, 200);
    }

    public function profile($user_id){
        $user = User::find($user_id);

        return view('user.profile', array(
            'user' => $user
        ));
    }



}
