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
            <h5> {{config('app.nav_section6')}} </h5>
        </div>

        <div class="card-body">
            <form action="{{ route('section6.update',['section6'=>$section6->id]) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Descripción: </label>
                    <input type="text" name="description" class="form-control" value="{{ $section6->description }}">
                    @error('description') <div class="text-danger text-center">Valor requerido</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Teléfono: </label>
                    <input type="text" name="phone" class="form-control" value="{{ $section6->phone }}">
                    @error('phone') <div class="text-danger text-center">Valor requerido</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Correo electrónico: </label>
                    <input type="text" name="email" class="form-control" value="{{ $section6->email }}">
                    @error('email') <div class="text-danger text-center">Valor requerido</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Localización: </label>
                    <input type="text" name="location" class="form-control" value="{{ $section6->location }}">
                    @error('location') <div class="text-danger text-center">Valor requerido</div>@enderror
                </div>

                <div class="text-right mt-3">
                    <button type=" submit" class="btn btn-primary">Actualizar</button>
                </div>

            </form>
        </div> <!-- card body  -->
    </div> <!-- card border  -->
</div> <!-- container  -->

@endsection