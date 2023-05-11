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
            <h5>{{config('app.nav_section2')}} / IMÁGENES / {{$section2_img->title}}</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('section2_img.update',['section2_img'=>$section2_img->id]) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Título: </label>
                    <input type="text" name="title" class="form-control" value="{{ $section2_img->title }}">
                    @error('title') <div class="text-danger text-center">Valor requerido</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Descripción: </label>
                    <textarea rows="5" class="w-100" type="text" name="description" class="form-control">{{ $section2_img->description}}</textarea>
                    @error('description') <div class="text-danger text-center">Valor requerido</div>@enderror
                </div>

                <div>
                    <label for="title" class="form-label">Imagen actual: </label>
                </div>

                <div class='mb-3 text-center'>
                    <div class="ratio ratio-1x1">
                        <div>
                            <a href="{{URL::asset('/images/'.$section2_img->image)}}" target="_blank">
                                <img class='img-thumbnail img-md mb-3 mr-2' src="{{URL::asset('/images/'.$section2_img->image)}}" />
                            </a>
                        </div>
                    </div>

                    <br />
                    <p>{{ $section2_img->image }}</p>

                    <input type="file" name="url_img" class="form-control w-100" value="{{ $section2_img->image }}">
                </div>


                <div class="text-right mt-3">
                    <button type=" submit" class="btn btn-primary">Actualizar</button>
                </div>

            </form>
        </div> <!-- card body  -->
    </div> <!-- card border  -->
</div> <!-- container  -->

@endsection