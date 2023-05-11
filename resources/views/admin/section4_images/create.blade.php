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
            <h5>{{config('app.nav_section4')}} / Nuevo</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('section4_images.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Nombre: </label>
                    <input type="text" name="name" class="form-control" value="">
                    @error('name') <div class="text-danger text-center">Valor requerido</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Role: </label>
                    <input type="text" name="role" class="form-control" value="">
                    @error('role') <div class="text-danger text-center">Valor requerido</div>@enderror
                </div>

                <div>
                    <label for="title" class="form-label">Imagen: </label>
                </div>

                <div class='mb-3 text-center'>
                    <input type="file" name="image" class="form-control w-100" value="">
                    @error('image') <div class="text-danger text-center">Valor requerido</div>@enderror
                </div>


                <div class="text-right mt-3">
                    <button type=" submit" class="btn btn-primary">Crear</button>
                </div>

            </form>
        </div> <!-- card body  -->
    </div> <!-- card border  -->
</div> <!-- container  -->

@endsection