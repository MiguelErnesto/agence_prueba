@extends('layouts.app2')
@push('page-meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <ul class="nav nav-tabs mb-3" id="myTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="tab1-tab" data-mdb-toggle="tab" href="#tab1" role="tab" aria-controls="tab1"
                aria-selected="true">
                Por Consultor
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="tab2-tab" data-mdb-toggle="tab" href="#tab2" role="tab" aria-controls="tab2"
                aria-selected="false">
                Por Cliente
            </a>
        </li>
    </ul>

    <div class="tab-content" id="myTabsContent">
        <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
            {{-- contenido pestaña 1 --}}
            <form id="pesquisaAvancada" class="border p-4 rounded bg-white shadow-sm">
                <div class="row align-items-center">
                    <label for="inpFechaInicio" class="col-md-2 col-form-label text-md-end fw-bold">
                        <h6> Período</h6>
                    </label>
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text">De</span>
                            <input type="month" id="inpFechaInicio" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text">A</span>
                            <input type="month" id="inpFechaFin" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-4 text-center mt-3 mt-md-0 d-flex justify-content-around">
                        <button type="submit" id="btnRelatorio" class="btn btn-outline-primary btn-bg-icon">
                            Relatório
                        </button>
                        <button type="button" id="btnGraficoBarras" class="btn btn-outline-success btn-bg-icon">
                            Gráfico
                        </button>
                        <button type="button" id="btnGraficoPizza" class="btn btn-outline-warning btn-bg-icon">
                            Pizza
                        </button>
                    </div>
                </div>

            </form>

            <form>
                <div class="row align-items-center">

                    <!-- Lista origen -->
                    <div class="col-md-5 my-3">
                        <label for="list1" class="form-label fw-bold pl-1">
                            <h6> Consultores
                                disponível</h6>
                        </label>
                        <select id="list1" name="list1[]" class="form-select" size="10" style="max-height: 150px;"
                            multiple aria-label="Consultores disponibles">
                            @foreach ($consultores as $consultor)
                                <option value="{{ $consultor->co_usuario }}">
                                    {{ $consultor->no_usuario }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Botones mover -->
                    <div class="col-md-2 d-flex flex-column justify-content-center align-items-center gap-3 mb-0">
                        <button type="button" class="btn btn-primary btn-move" onclick="moveOptions('list1', 'list2')"
                            aria-label="Agregar">
                            &gt;&gt; </button>
                        <button type="button" class="btn btn-secondary btn-move" onclick="moveOptions('list2', 'list1')"
                            aria-label="Quitar">
                            &lt;&lt; </button>
                    </div>

                    <!-- Lista destino -->
                    <div class="col-md-5 my-3">
                        <label for="list2" class="form-label fw-bold pl-1">
                            <h6> Consultores
                                selecionado</h6>
                        </label>
                        <select id="list2" name="list2[]" class="form-select" size="10" style="max-height: 150px;"
                            multiple aria-label="Consultores seleccionados"></select>
                        <input type="hidden" name="lista_analista" value="" id="lista_analista" />
                    </div>
                </div>
            </form>


            {{-- Resultados relatorio --}}
            <div id='divResultadosRelatorio' class="table-responsive">
                <div id='tableResultadosRelatorio' class="table-responsive">

                </div>
            </div>

            {{-- Grafico barras --}}
            <div id='divGraficoBarras'>
                <div id='divResultadosGraficoBarras'>
                    <canvas id="graficoBarras" width="400" height="200"></canvas>
                </div>
            </div>

            {{-- Grafico pizza --}}
            <div id='divGraficoPizza'>
                <div id='divResultadosGraficoPizza' class="text-center">
                    <canvas id="graficoPizza" width="400" height="200"
                        style="max-width: 800px; max-height: 800px;display: inline-block;"></canvas>
                </div>
            </div>
        @endsection

        @push('page-js')
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"></script>
            <script async type="module" src="js/consultores.js"></script>
            <script async type="module" src="js/grafico_barras.js"></script>
            <script async type="module" src="js/grafico_pizza.js"></script>

            <script>
                function moveOptions(fromId, toId) {
                    const fromSelect = document.getElementById(fromId);
                    const toSelect = document.getElementById(toId);
                    const selectedOptions = Array.from(fromSelect.options).filter(option => option.selected);

                    selectedOptions.forEach(option => {
                        // Clona la opción y la agrega al select destino
                        const newOption = new Option(option.text, option.value);
                        toSelect.add(newOption);
                        // Remueve la opción original del select de origen
                        fromSelect.remove(option.index);
                    });
                }
            </script>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        @endpush

        @push('page-css')
            <!-- Bootstrap CSS -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
            <!-- MDB CSS -->
            <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.css" rel="stylesheet" />
            <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
                integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l"
                crossorigin="anonymous">
            <link rel="stylesheet" href="css/style.css">
        @endpush
