@extends('adminlte::page')

@section('content')

<div class="container w-75 p-4">
    <div class="card border border-dark">
        <div class="card-header bg-dark">
            <h5>Cambiar contraseña</h5>
        </div>
        <div class="card-body">

            <form action="{{ route('update-password') }}" method="POST">
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

                    <div class="mb-4">
                        <label for="oldPasswordInput" class="form-label">Contraseña actual:</label>
                        <input name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" id="oldPasswordInput" placeholder="">
                        @error('old_password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="newPasswordInput" class="form-label">Nueva contraseña:</label>
                        <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="newPasswordInput" placeholder="">
                        @error('new_password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="confirmNewPasswordInput" class="form-label">Confirmar nueva contraseña:</label>
                        <input name="new_password_confirmation" type="password" class="form-control" id="confirmNewPasswordInput" placeholder="">
                    </div>

                </div>
                <div class="text-right">
                    <button class="btn btn-primary">Confirmar</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection