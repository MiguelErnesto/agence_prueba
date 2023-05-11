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
            <h5>Pie de página</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('footer.update',['footer'=>$footer->id]) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Símbolo: </label>
                    <input type="text" name="symbol" class="form-control" value="{{ $footer->symbol }}">
                    @error('symbol') <div class="text-danger text-center">Valor requerido</div>@enderror
                </div>

                <div class="input-group">
                    <div class="mr-5 mb-3">
                        <label for="title" class="form-label">Año: </label>
                        <input type="text" name="year" class="form-control" value="{{ $footer->year }}">
                        @error('year') <div class="text-danger text-center">Valor requerido</div>@enderror
                    </div>

                    <div class="ml-4 mb-5">
                        <label for="title" class="form-label">Propietario: </label>
                        <input type="text" name="owner" class="form-control" value="{{ $footer->owner }}">
                        @error('owner') <div class="text-danger text-center">Valor requerido</div>@enderror
                    </div>
                </div>


                <div>
                    <label for="title" class="form-label">Imagen de fondo actual: </label>
                </div>

                <div class="ratio ratio-1x1 mb-5">
                    <div>
                        <a href="{{URL::asset('/images/'.$footer->image)}}" target="_blank">
                            <img class='img-thumbnail img-md mb-3 mr-2' src="{{URL::asset('/images/'.$footer->image)}}" />
                        </a>
                    </div>

                    <br />
                    <p>{{ $footer->image }}</p>

                    <input type="file" name="url_img" class="form-control w-100" value="{{ $footer->image }}">
                </div>


                <div class="mb-3">
                    <label for="title" class="form-label">Otros detalles: &nbsp;&nbsp;&nbsp;[opcionales]</label>
                    <input type="text" name="other_details" class="form-control" value="{{ $footer->other_details }}">
                </div>

                <div class="input-group">
                    <div class="mr-5 mb-3">
                        <label for="title" class="form-label">Nombre del enlace: </label>
                        <input type="text" name="name_link" class="form-control" value="{{ $footer->name_link }}">
                    </div>
                    <div class="ml-4 mb-3">
                        <label for="title" class="form-label">Url:</label>
                        <input type="text" name="link" class="form-control" value="{{ $footer->link }}">
                    </div>
                </div>


                <div class="text-right mt-3">
                    <button type=" submit" class="btn btn-primary">Actualizar</button>
                </div>

            </form>
        </div> <!-- card body  -->
    </div> <!-- card border  -->
</div> <!-- container  -->

@endsection