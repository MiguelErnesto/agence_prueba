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
            <h5>{{config('app.nav_section3')}} / NUEVA IMAGEN </h5>
        </div>

        <div class="card-body">
            <form action="{{ route('section3_category_images.store')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Categoría: </label>

                    <select name="category_id" class="form-select mb-3 w-100 bg-white" aria-label="Default select example">
                        <option value="{{$section3_category[0]->id}}" selected> {{$section3_category[0]->name}}</option>
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
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