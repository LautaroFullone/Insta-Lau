<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' =>'usuario'], function(){

    Route::get('/configuracion', 'UserController@config')->name('user.config');
    Route::post('/actualizar', 'UserController@update')->name('user.update');
    Route::get('/avatar/{file_name}', 'UserController@getImage')->name('user.avatar');
    Route::get('/subir-imagen', 'ImageController@create')->name('image.create');
    Route::get('/perfil/{user_id}', 'UserController@profile')->name('user.profile');
    Route::get('/listado-usuarios/{search?}', 'UserController@index')->name('user.index');
    Route::post('/buscar-usuarios', 'UserController@search')->name('user.search');


});

Route::group(['prefix' =>'imagen'], function(){
    Route::post('/guardar-imagen', 'ImageController@save')->name('image.save');
    Route::get('/traer/{file_name}', 'ImageController@getImage')->name('image.traer');
    Route::get('/detalle/{id}', 'ImageController@detail')->name('image.detail');
    Route::post('/guardar-comentario', 'CommentController@save')->name('comment.save');
    Route::get('/eliminar-comentario/{id}', 'CommentController@delete')->name('comment.delete');
    Route::get('/dar-like/{image_id}', 'LikeController@like')->name('like.save');
    Route::get('/dar-dislike/{image_id}', 'LikeController@dislike')->name('like.delete');
    Route::get('/mostrar-likes', 'LikeController@showlikes')->name('like.show');
    Route::get('/eliminar/{image_id}', 'ImageController@delete')->name('image.delete');
    Route::get('/editar/{image_id}', 'ImageController@edit')->name('image.edit');
    Route::post('/actualizar', 'ImageController@update')->name('image.update');


});


//--------------------------------------------------------------------------------------------------------
/*
use App\Image as Image;

Route::get('/', function () {

    $images = Image::all();

    foreach($images as $image){
        echo $image->image_path . "<br>";
        echo $image->description . "<br>";
        echo $image->user->name. ' '. $image->user->surname ;

        if(count($image->comments) >=1 ) //muestra comentarios si los hay
        {
            echo "<h4> >>Comentarios<< </h4>";

            foreach($image->comments as $comment){
                echo "<li>(". $image->user->nick . '):    ';
                echo $comment->content. "</li><br>";
            }
            echo "</ul>";
        }

        echo "<br>LIKES: ". count($image->likes);
        echo '<br><hr>';

    }

    die();
    return view('welcome');
});*/




