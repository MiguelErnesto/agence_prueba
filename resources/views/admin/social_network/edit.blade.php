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
            <h5> Redes sociales / {{$social_network->name}}</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('social_network.update',['social_network'=>$social_network->id]) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Nombre: </label>
                    <input type="text" name="name" class="form-control" value="{{ $social_network->name }}">
                    @error('name') <div class="text-danger text-center">Valor requerido</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Enlace: </label>
                    <input type="text" name="url" class="form-control" value="{{ $social_network->url }}">
                    @error('url') <div class="text-danger text-center">Valor requerido</div>@enderror
                </div>

                <div>
                    <label for="title" class="form-label">Imagen actual: </label>
                </div>

                <div class='mb-3 text-center'>
                    <div class="ratio ratio-1x1">
                        <div>
                            <a href="{{URL::asset('/images/'.$social_network->image)}}" target="_blank">
                                <img class='img-thumbnail img-md mb-3 mr-2 rounded-circle' src="{{URL::asset('/images/'.$social_network->image)}}" />
                            </a>
                        </div>
                    </div>

                    <br />
                    <p>{{ $social_network->image }}</p>

                    <input type="file" name="url_img" class="form-control w-100" value="{{ $social_network->image }}">
                </div>


                <div class="text-right mt-3">
                    <button type=" submit" class="btn btn-primary">Actualizar</button>
                </div>

            </form>
        </div> <!-- card body  -->
    </div> <!-- card border  -->
</div> <!-- container  -->

@endsection