@extends('adminlte::page')

@section('content')

@if (session('success'))
<h6 class="alert alert-success">{{ session('success') }}</h6>
@endif
@error('title')
<h6 class="alert alert-danger">{{ $message }}</h6>
@enderror

<br />
<div class="container w-50 p-4">
    <div class="card border border-dark">
        <div class="card-header bg-dark">
            <h5>{{config('app.nav_section1')}}</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('section1.update',['section1'=>$section1->id]) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Texto principal:</label>
                    <input type="text" name="title1" class="form-control" value="{{ $section1->title1 }}">
                    @error('title1') <div class="text-danger text-center">Valor requerido</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Texto secundario: </label>
                    <input type="text" name="title2" class="form-control" value="{{ $section1->title2 }}">
                    @error('title2') <div class="text-danger text-center">Valor requerido</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Texto del botón: </label>
                    <input type="text" name="lb_btn_sctn2" class="form-control" value="{{ $section1->lb_btn_sctn2 }}">
                    @error('lb_btn_sctn2') <div class="text-danger text-center">Valor requerido</div>@enderror
                </div>

                <div>
                    <label for="title" class="form-label">Imagen de fondo actual: </label>
                </div>

                <div class='mb-3 text-center'>
                    <div class="ratio ratio-1x1">
                        <div>
                            <a href="{{URL::asset('/images/'.$section1->image)}}" target="_blank">
                                <img class='img-thumbnail img-md mb-3 mr-2' src="{{URL::asset('/images/'.$section1->image)}}" />
                            </a>
                        </div>

                        <br />
                        <p>{{ $section1->image }}</p>

                        <input type="file" name="url_img" class="form-control w-100" value="{{ $section1->image }}">
                    </div>


                    <div class="text-right mt-3">
                        <button type=" submit" class="btn btn-primary">Actualizar</button>
                    </div>

            </form>
        </div> <!-- card body  -->
    </div> <!-- card border  -->
</div> <!-- container  -->

@endsection