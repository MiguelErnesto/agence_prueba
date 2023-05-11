@extends('adminlte::page')

@section('content')
@if (session('success'))
<h6 class="alert alert-success">{{ session('success') }}</h6>
@endif
@error('title')
<h6 class="alert alert-danger">{{ $message }}</h6>
@enderror
<br />
<h3 class='text-center'>VISTA PREVIA DEL SITIO WEB</h3>
<hr />

<form action="{{ route('front_preview.update',['front_preview'=>1]) }}" method="POST">
  @method('PATCH')
  @csrf
  <div class="container w-100 text-center">
    <div class="form-check form-check-inline mr-4">
      <label for="title" class="form-label"><strong>URL: </strong></label>
    </div>

    <div class="form-check form-check-inline">
      <input type="text" name="url" class="form-control" value="{{config('app.front_url')}} ">
      @error('url') <div class="text-danger text-center">Valor requerido</div>@enderror
    </div>

    <div class="form-check form-check-inline">
      <button type=" submit" class="btn btn-primary">Actualizar</button>
    </div>
  </div>
</form>
<hr />
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="{{config('app.front_url')}}" allowfullscreen></iframe>
</div>
@endsection