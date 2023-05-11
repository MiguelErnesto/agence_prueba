@extends('adminlte::page')

@section('content')

@if (session('success'))
<h6 class="alert alert-success">{{ session('success') }}</h6>
@endif
@error('title')
<h6 class="alert alert-danger">{{ $message }}</h6>
@enderror

<br />
<div class="container w-75 p-4">
    <div class="card border border-dark">
        <div class="card-header bg-dark">
            <h5>{{config('app.nav_section5')}} / {{$section5_tabla->elemento}}</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('section5_tabla.update',['section5_tabla'=>$section5_tabla->id]) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf

                <div class="mb-5">
                    <label for="title" class="form-label">Elemento: </label>
                    <input type="text" name="elemento" class="form-control" value="{{ $section5_tabla->elemento }}">
                    @error('elemento') <div class="text-danger text-center">Valor requerido</div>@enderror
                </div>

                <div class="input-group">
                    <div class="mr-5 mb-3">
                        <label for="title" class="form-label">Unidad de Medida: </label>
                        <input type="text" name="u_m" class="form-control" value="{{ $section5_tabla->u_m }}">
                        @error('u_m') <div class="text-danger text-center">Valor requerido</div>@enderror
                    </div>

                    <div class="mb-3 ml-5">
                        <label for="title" class="form-label">Cantidad: </label>
                        <input type="text" name="cantidad" class="form-control" value="{{ $section5_tabla->cantidad }}">
                        @error('cantidad') <div class="text-danger text-center">Valor requerido</div>@enderror
                    </div>

                    <div class="mr-5 mb-3">
                        <label for="title" class="form-label">Precio: </label>
                        <input type="text" name="precio" class="form-control" value="{{ $section5_tabla->precio }}">
                        @error('precio') <div class="text-danger text-center">Valor requerido</div>@enderror
                    </div>

                    <div class="mb-3 ml-5">
                        <label for="title" class="form-label">Importe: </label>
                        <input type="text" name="importe" class="form-control" value="{{ $section5_tabla->importe }}">
                        @error('importe') <div class="text-danger text-center">Valor requerido</div>@enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label mt-4">Categoría asociada en la galería de imágenes: </label>
                    <select name="section3_category_id" class="form-select mb-3 w-100 bg-white" aria-label="Default select example">
                        <option value="{{$section5_tabla->section3_category_id}}" selected> {{$section5_category_name[0]->name}}</option>
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>


                <div class="mb-3 mt-4">
                    <label for="title" class="form-label">Descripción: </label>
                    <textarea rows="5" class="w-100" type="text" name="descripcion" class="form-control">{{ $section5_tabla->descripcion}}</textarea>
                    @error('descripcion') <div class="text-danger text-center">Valor requerido</div>@enderror
                </div>

                <div class="text-right mt-3">
                    <button type=" submit" class="btn btn-primary">Actualizar</button>
                </div>

            </form>
        </div> <!-- card body  -->
    </div> <!-- card border  -->
</div> <!-- container  -->

@endsection