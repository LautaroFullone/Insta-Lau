@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1 style="text-align: center">Mis imagenes favoritas</h1>
            <hr>

            <!-- PAGINACION -->
            <div class="clearfix "></div>
            {{$likes->links()}}

            @foreach($likes as $like)

            @include('includes.image', array('image' => $like->image))

                @include('image.showComments', array('image' => $like->image))

            @endforeach

             <!-- PAGINACION -->
             <div class="clearfix "></div>
             {{$likes->links()}}




        </div>
    </div>

</div>
@endsection
