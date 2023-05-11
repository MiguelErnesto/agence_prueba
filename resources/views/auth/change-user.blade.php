@extends('adminlte::page')

@section('content')

<div class="container w-75 p-4">
    <div class="card border border-dark">
        <div class="card-header bg-dark">
            <h5>Cambiar datos del Administrador</h5>
        </div>
        <div class="card-body">

            <form action="{{ route('update-user') }}" method="POST">
                @csrf
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @elseif (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                    @endif

                    <div class="mb-3">
                        <label for="title" class="form-label">Nombre de usuario:</label>
                        <input type="text" name="usuario" class="form-control" value="{{auth()->user()->name}}">
                        @error('usuario') <div class="text-danger text-center">Valor requerido</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Correo electrónico:</label>
                        <input type="email" name="email" class="form-control" value="{{auth()->user()->email}}">
                        @error('email') <div class="text-danger text-center">Valor requerido</div>@enderror
                    </div>

                </div>
                <div class="text-right">
                    <button class="btn btn-primary">Actualizar</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection