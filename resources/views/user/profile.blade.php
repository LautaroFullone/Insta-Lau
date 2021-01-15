@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1 style="text-align: center">Perfil de Usuario</h1>
            <hr>

            <div class="profile-user">

                @if($user->image)
                    <div class="container-avatar">
                        <img src="{{ route('user.avatar', array('file_name' => $user->image)) }}" class="avatar"/>
                    </div>
                @endif

                <div class="user-info">
                    <h1>{{'@'.$user->nick}}</h1>
                    <h2>{{$user->name.' '.$user->surname}}</h2>
                    <p class="color-gray">{{"Se unio: ".FormatTime::LongTimeFilter($user->created_at)}}</p>
                </div>

                <div class="clearfix"></div>
                <hr>
            </div>

            <div class="clearfix"></div>

            @foreach($user->images as $image)
                {{-- MOSTRAR UNA TARJETA SOLA--}}
                @include('includes.image', array('image' => $image))

                @include('image.showComments')
            @endforeach

    </div>

</div>
@endsection
