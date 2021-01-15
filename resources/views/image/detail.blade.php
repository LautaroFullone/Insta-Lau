@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            @include('includes.message')

            <h1 style="text-align: center">Detalle de Imagen</h1>
            <hr>

                <div class="card pub_image pub_image_detail">

                    <div class="card-header">

                        @if($image->user->image)
                            <div class="container-avatar">
                                <img src="{{ route('user.avatar', array('file_name' => $image->user->image)) }}" class="avatar"/>
                            </div>
                        @endif

                        <span class="data-user">
                            {{ $image->user->name  . ' ' .$image->user->surname }}
                            <span class="color-gray">{{ ' | @' .$image->user->nick}}</span>
                        </span>

                        @if(Auth::user() && Auth::user()->id == $image->user->id )
                            <ul class="nav-item dropdown float-right">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle btn btn-outline-secondary " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Configuracion
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('image.edit', array('image_id' => $image->id)) }}">
                                        Editar
                                    </a>

                                    <span data-toggle="modal" data-target="#confirmar">
                                        <a class="dropdown-item" href="#">
                                            Eliminar
                                        </a>
                                    </span>



                                </div>
                            </ul>
                        @endif

                        <span class="datetime">{{FormatTime::LongTimeFilter($image->created_at)}}</span>

                    </div>

                    <div class="card-body">

                        <div class="image-detail">
                            <img src="{{ route('image.traer', array('file_name' => $image->image_path)) }}" >
                        </div>



                        <div class="description">
                            <span class="color gray">{{'@'.$image->user->nick. ': '}}</span>
                            <span>{{$image->description}}</span>

                            <div class="likes">
                                <span class="color-gray">{{ count($image->likes) }}</span>

                                {{--COMPROBAR SI EL USUARIO LOGUEADO LE DIO LIKE A LA PUBLICACION--}}
                                <?php $user_like = false; ?>

                                @foreach ($image->likes as $like)
                                    @if ($like->user->id == Auth::user()->id)
                                        <?php $user_like = true; ?>
                                    @endif
                                @endforeach

                                @if ($user_like)
                                    <img class="btn-dislike"src="{{asset('img/heart-red.png')}}" data-id="{{$image->id}}">
                                @else
                                    <img class="btn-like"src="{{asset('img/heart-black.png')}}" data-id="{{$image->id}}" >
                                @endif
                            </div>
                        </div>


                        <span data-toggle="modal" data-target="#mostrar{{$image->id}}">
                            <a href="#" class="btn btn-outline-dark btn-lg btn-comments">Comentarios ({{count($image->comments)}})</a>
                        </span>





                        <div class="comments">
                            <h3>Deja tu comentario: </h3>
                            <hr>
                            <form method='POST'action="{{ route('comment.save') }}">
                                @csrf
                                <input type="hidden" name="image_id" value="{{$image->id}}">
                                <p>
                                    <textarea class="form-control" name="content" ></textarea>

                                    @if ($errors->has('content'))
                                        <div class="form-group row">
                                            <div class="mx-auto"> {{--CENTRAR UN DIV (tiene q ser dentro de fila)--}}
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        <li>{{$errors->first('content')}}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </p>
                                    <div class="float-right boton">
                                        <button type="submit" class="btn btn-outline-success btn-lg ">Enviar </button>
                                    </div>

                                </form>
                            </div>
                        </div>

                    </div>
                    @include('image.showComments')
                    @include('includes.confirm')
                </div>

        </div>
    </div>

</div>
@endsection
