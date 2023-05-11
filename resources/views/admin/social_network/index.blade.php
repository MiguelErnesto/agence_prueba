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
            <h5>Redes sociales</h5>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="bg-light table-sm">
                            <th scope="col">&nbsp;&nbsp;&nbsp;&nbsp;Imagen</th>
                            <th scope="col"></th>
                            <th scope="col">&nbsp;&nbsp;&nbsp;&nbsp;Enlace</th>
                            <th scope="col"> </th>
                            <th scope="col" class="bg-dark text-center">
                                <a href="{{ route('social_network.create')}}">
                                    <i class="fa fa-file fa-lg"></i>
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($social_networks as $social_network)
                        <tr>

                            <td class="img-responsive">
                                <div class="ratio ratio-1x1">
                                    <div>
                                        <a href="{{URL::asset('/images/'.$social_network->image)}}" target="_blank">
                                            <img class='img-thumbnail img-md img-responsive rounded-circle' src="{{URL::asset('/images/'.$social_network->image)}}" />
                                        </a>
                                    </div>
                                </div>
                            </td>

                            <td class='align-middle'>
                                {{ $social_network->name }}
                            </td>

                            <td class='align-middle'>
                                <a class="d-flex align-items-center gap-2" href="{{ $social_network->url }}">
                                    {{ $social_network->url }}
                                </a>
                            </td>


                            <td class="align-middle">
                                <a href="{{ route('social_network.edit',['social_network'=>$social_network->id]) }}">
                                    <button class="btn btn-link">
                                        <i class="fa fa-edit fa-lg" style="color:#31ab59"></i>
                                    </button>
                                </a>
                            </td>
                            <td class="align-middle">
                                <form action="{{ route('social_network.destroy',[$social_network->id]) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-link" onclick="return confirm('¿Seguro desea eliminar la información de {{$social_network->name}}?')">
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