@extends('layouts.app')


@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">

                <div class="card-header">
                    Subir nueva imagen
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('image.save') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="image_path" class="col-md-3 col-form-label text-md-right">Imagen</label>
                            <div class="col-md-7">
                                <input type="file" id="image_path" name="image_path" required>
                            </div>
                        </div>

                        @if ($errors->any())

                        <div class="form-group row">
                            <div class="mx-auto"> {{--CENTRAR UN DIV (tiene q ser dentro de fila)--}}
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="form-group row">
                            <label for="image_path" class="col-md-3 col-form-label text-md-right">Descripción</label>
                            <div class="col-md-7">
                                <textarea id="description" name="description" class="form-control" required></textarea>

                                @if($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong> {{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-6 offset-md-3">
                                <input type="submit" class="btn btn-outline-success" value="Subir Imagen">
                            </div>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>
</div>

@endsection
