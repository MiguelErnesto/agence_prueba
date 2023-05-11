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
            <h5>MENÚ SUPERIOR</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('navbar.update',['navbar'=>$navbar->id]) }}" method="POST">
                @method('PATCH')
                @csrf

                <p><strong>Secciones: </strong></p>
                <div class="mb-3">
                    <!-- Section 1 -->
                    <div class="form-check form-check-inline p-3 ml-5">
                        <label class="form-check-label" for="flexCheckChecked">
                            <input class="form-check-input" type="checkbox" name="nav_chk1" @if (config('app.nav_chk1')) checked @endif>
                            Mostrar
                            <input type="text" name="item1" class="form-control" value="{{ $navbar->item1 }}">
                            @error('item1') <div class="text-danger text-center">Valor requerido</div>@enderror
                        </label>
                    </div>

                    <!-- Section 2 -->
                    <div class="form-check form-check-inline p-3 ml-5">
                        <label class="form-check-label" for="flexCheckChecked">
                            <input class="form-check-input" type="checkbox" name="nav_chk2" @if (config('app.nav_chk2')) checked @endif>
                            Mostrar
                            <input type="text" name="item2" class="form-control" value="{{ $navbar->item2 }}">
                            @error('item2') <div class="text-danger text-center">Valor requerido</div>@enderror
                        </label>
                    </div>
                </div>

                <div class="mb-3">
                    <!-- Section 3 -->
                    <div class="form-check form-check-inline p-3 ml-5">
                        <label class="form-check-label" for="flexCheckChecked">
                            <input class="form-check-input" type="checkbox" name="nav_chk3" @if (config('app.nav_chk3')) checked @endif>
                            Mostrar
                            <input type="text" name="item3" class="form-control" value="{{ $navbar->item3 }}">
                            @error('item3') <div class="text-danger text-center">Valor requerido</div>@enderror
                        </label>
                    </div>

                    <!-- Section 4 -->
                    <div class="form-check form-check-inline p-3 ml-5">
                        <label class="form-check-label" for="flexCheckChecked">
                            <input class="form-check-input" type="checkbox" name="nav_chk4" @if (config('app.nav_chk4')) checked @endif>
                            Mostrar
                            <input type="text" name="item4" class="form-control" value="{{ $navbar->item4 }}">
                            @error('item4') <div class="text-danger text-center">Valor requerido</div>@enderror
                        </label>
                    </div>
                </div>

                <div class="mb-3">
                    <!-- Section 5 -->
                    <div class="form-check form-check-inline p-3 ml-5">
                        <label class="form-check-label" for="flexCheckChecked">
                            <input class="form-check-input" type="checkbox" name="nav_chk5" @if (config('app.nav_chk5')) checked @endif>
                            Mostrar
                            <input type="text" name="item5" class="form-control" value="{{ $navbar->item5 }}">
                            @error('item5') <div class="text-danger text-center">Valor requerido</div>@enderror
                        </label>
                    </div>

                    <!-- Section 6 -->
                    <div class="form-check form-check-inline p-3 ml-5">
                        <label class="form-check-label" for="flexCheckChecked">
                            <input class="form-check-input" type="checkbox" name="nav_chk6" @if (config('app.nav_chk6')) checked @endif>
                            Mostrar
                            <input type="text" name="item6" class="form-control" value="{{ $navbar->item6 }}">
                            @error('item6') <div class="text-danger text-center">Valor requerido</div>@enderror
                        </label>
                    </div>
                </div>

                <div class="text-right"><button type=" submit" class="btn btn-primary">Actualizar</button></div>
            </form>
        </div>
    </div>
</div>


@endsection