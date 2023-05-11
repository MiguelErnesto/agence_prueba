@extends('adminlte::page')

@section('content')

@if (session('success'))
<h6 class="alert alert-success">{{ session('success') }}</h6>
@endif
@error('title')
<h6 class="alert alert-danger">{{ $message }}</h6>
@enderror

<br />
<div class="container w-100 p-4">
    <div class="card border border-dark">
        <div class="card-header bg-dark">
            <h5>{{config('app.nav_section3')}}</h5>
        </div>
        <div class="card-body">

            <form action="{{ route('section3.update',['section3'=>$section3->id]) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="mb-3 table-responsive">
                    <label for="title" class="form-label"><strong>Descripción: </strong></label>
                    <table class="w-100">
                        <tr class="text-center">
                            <td>
                                <input type="text" name="description" class="form-control mr-5 w-100" value="{{ $section3->description }}">
                                @error('description') <div class="text-danger text-center">Valor requerido</div>@enderror

                            </td>
                            <td>
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
            <br />
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="bg-light table-sm">
                            <th scope="col">&nbsp;&nbsp;&nbsp;Categorías</th>
                            <th scope="col" class="text-center">Imágenes asociadas</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col" class="bg-dark text-center"><a href="{{ route('section3_categories.create')}}">
                                    <i class="fa fa-file fa-lg"></i>
                                </a></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($section3_categories as $section3_category)
                        <tr>
                            <td class='w-50'>
                                &nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;
                                {{ $section3_category->name }}
                            </td>
                            <td class='w-25 text-center'>
                                <a href="{{ route('section3_category_images.index',['section3_category_id'=>$section3_category->id]) }}">
                                    <button class="btn btn-link">
                                        <i class="fa fa-image fa-lg" style="color:primary"></i>
                                    </button>
                                </a>
                            </td>

                            <td class="w-25">

                            </td>

                            <td class="align-middle">
                                <a href="{{ route('section3_categories.edit',['section3_category'=>$section3_category->id]) }}">
                                    <button class="btn btn-link">
                                        <i class="fa fa-edit fa-lg" style="color:#31ab59"></i>
                                    </button>
                                </a>
                            </td>
                            <td class="align-middle">
                                <form action="{{ route('section3_categories.destroy',[$section3_category->id]) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-link" onclick="return confirm('¿Seguro desea eliminar la categoría: {{$section3_category->name}}?. Al hacerlo se eliminarán todos los elementos asociados a esa categoría.')">
                                        <i class="fa fa-trash fa-lg" style="color:#f16d6d"></i>
                                    </button>
                                </form>
                            </td>





                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection