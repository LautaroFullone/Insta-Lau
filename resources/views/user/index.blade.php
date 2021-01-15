@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1 style="text-align: center">Perfiles de Usuarios</h1>
            <br>
            <form method="POST" action="{{ route('user.search') }}">
                @csrf
                    <div class="form-group row ">

                        <div class="form-group col">

                        </div>

                        <div class="form-group col">
                            <input type="text" name="searching" class="form-control">
                        </div>

                        <div class="form-group col">
                            <input type="submit" class="btn btn-outline-success" value="Buscar">
                        </div>

                    </div>

            </form>
            <hr>

            @include('includes.message')

            <!-- PAGINACION -->
            <div class="clearfix "></div>
            {{$users->links()}}

            @foreach ($users as $user)

                <div class="profile-user">

                    @if($user->image)
                        <div class="container-avatar">
                            <img src="{{ route('user.avatar', array('file_name' => $user->image)) }}" class="avatar"/>
                        </div>
                    @endif

                    <span class="user-info">

                        <h2>{{'@'.$user->nick}}</h2>

                        <h3>{{$user->name.' '.$user->surname}}</h3>
                        <p class="color-gray">{{"Se unio: ".FormatTime::LongTimeFilter($user->created_at)}}</p>

                        <a type="button" href="{{ route('user.profile', array('user_id' => $user->id)) }}" class="btn btn-outline-dark ">Ver Perfil</a>

                    </span>

                    <div class="clearfix"></div>
                    <hr>
                </div>
            @endforeach

            <!-- PAGINACION -->
            <div class="clearfix"></div>
            {{$users->links()}}

        </div>
    </div>

</div>
@endsection
