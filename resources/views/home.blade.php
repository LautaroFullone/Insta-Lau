@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1 style="text-align: center">Inicio</h1>
            <hr>

            @include('includes.message')

            <!-- PAGINACION -->
            <div class="clearfix "></div>
            {{$images->links()}}

            @foreach($images as $image)
                {{-- MOSTRAR UNA TARJETA SOLA--}}
                @include('includes.image', array('image' => $image))

                @include('image.showComments')
            @endforeach

            <!-- PAGINACION -->
            <div class="clearfix"></div>
            {{$images->links()}}

        </div>
    </div>

</div>
@endsection
