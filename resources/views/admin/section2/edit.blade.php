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
            <h5>{{config('app.nav_section2')}}</h5>
        </div>
        <div class="card-body">

            <form action="{{ route('section2.update',['section2'=>$section2->id]) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="mb-3 table-responsive">
                    <label for="title" class="form-label"><strong>Descripción: </strong></label>
                    <table class="w-100">
                        <tr class="text-center">
                            <td>
                                <input type="text" name="description" class="form-control mr-5 w-100" value="{{ $section2->description }}">
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
                            <th scope="col" class="text-center">Detalles</th>
                            <th scope="col"></th>
                            <th scope="col"> </th>
                            <th scope="col"> </th>
                            <th scope="col" class="bg-dark text-center">
                                <a href="{{ route('section2_img.create')}}">
                                    <i class="fa fa-file fa-lg"></i>
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($section2_imgs as $section2_img)
                        <tr>
                            <td class='w-75'>
                                <a class="d-flex align-items-center gap-2" href="">
                                    {{ $section2_img->title }}
                                </a>
                                {{ $section2_img->description }}
                            </td>
                            <td class="img-responsive align-middle">
                                <div class="ratio ratio-1x1">
                                    <div>
                                        <a href="{{URL::asset('/images/'.$section2_img->image)}}" target="_blank">
                                            <img class='img-thumbnail img-md rounded-circle img-responsive' src="{{URL::asset('/images/'.$section2_img->image)}}" />
                                        </a>
                                    </div>
                                </div>
                            </td>

                            <td>

                            </td>

                            <td class="align-middle">
                                <a href="{{ route('section2_img.edit',['section2_img'=>$section2_img->id]) }}">
                                    <button class="btn btn-link">
                                        <i class="fa fa-edit fa-lg" style="color:#31ab59"></i>
                                    </button>
                                </a>
                            </td>
                            <td class="align-middle">
                                <form action="{{ route('section2_img.destroy',[$section2_img->id]) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-link" onclick="return confirm('¿Seguro desea eliminar la imagen: {{$section2_img->title}}?')">
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