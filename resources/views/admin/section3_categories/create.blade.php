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
            <h5>{{config('app.nav_section3')}} / NUEVA CATEGORÍA </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('section3_categories.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label"><strong>Nombre de la Categoría: </strong></label>
                    <input type="text" name="name" class="form-control" value="">
                    @error('name') <div class="text-danger text-center">Valor requerido</div>@enderror
                </div>

                <div class="text-right"><button type=" submit" class="btn btn-primary">Crear</button></div>
            </form>
        </div>
    </div>
</div>




@endsection