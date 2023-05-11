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
            <h5>{{config('app.nav_section3')}} / EDITAR IMAGEN </h5>
        </div>

        <div class="card-body">
            <form action="{{ route('section3_category_images.update',['section3_category_image'=>$section3_category_images->id]) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Categoría: </label>
                    <select name="category_id" class="form-select mb-3 w-100 bg-white" aria-label="Default select example">
                        <option value="{{$section3_category_images->section3_categories_id}}" selected> {{$section3_category_name[0]->name}}</option>
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="title" class="form-label">Imagen actual: </label>
                </div>

                <div class='mb-3 text-center'>
                    <div class="ratio ratio-1x1">
                        <div>
                            <a href="{{URL::asset('/images/'.$section3_category_images->image)}}" target="_blank">
                                <img class='img-thumbnail img-md mb-3 mr-2' src="{{URL::asset('/images/'.$section3_category_images->image)}}" />
                            </a>
                        </div>
                    </div>

                    <br />
                    <p>{{ $section3_category_images->image }}</p>

                    <input type="file" name="url_img" class="form-control w-100" value="{{ $section3_category_images->image }}">
                </div>


                <div class="text-right mt-3">
                    <button type=" submit" class="btn btn-primary">Actualizar</button>
                </div>

            </form>
        </div> <!-- card body  -->
    </div> <!-- card border  -->
</div> <!-- container  -->

@endsection