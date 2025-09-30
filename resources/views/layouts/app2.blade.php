<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title> --}}
    <title>CAOL - Controle de Atividades Online - Agence Interativa</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />

    <!-- Material Icons (opcional, si quieres usar iconos de Material Design) -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.css" rel="stylesheet" />

    <!-- Scripts -->

    <style>
        // resources/css/app.scss

        // Import Bootstrap (si no lo has hecho ya)
        @import '~bootstrap/scss/bootstrap';

        // Variables de Material Design (ajusta los colores a tu gusto)
        $primary: #3f51b5; // Indigo 500
        $navbar-height: 64px; // Altura estándar de la navbar en Material Design

        // Override Bootstrap variables
        $navbar-light-color: rgba(0, 0, 0, .6); // Text color
        $navbar-light-hover-color: rgba(0, 0, 0, .8); // Hover color
        $navbar-light-active-color: $primary; // Color cuando está activo

        // Estilos para la navbar
        .navbar {
            padding-top: 0;
            padding-bottom: 0;
            height: $navbar-height;
            background-color: #fff; // Fondo blanco (Material Design)

            .container {
                display: flex;
                align-items: center;
                justify-content: space-between;
                height: 100%;
            }

            .navbar-brand {
                font-weight: 500;
                font-size: 1.25rem;
                color: rgba(0, 0, 0, 0.87);
                /* Texto más oscuro */
            }

            .navbar-toggler {
                border: none;

                &:focus {
                    outline: none;
                    box-shadow: none; // Quita el borde al enfocar
                }
            }

            .navbar-nav {
                align-items: center;
                /* Alinea verticalmente los elementos */
            }

            .nav-link {
                font-size: 1rem;
                padding: 0.5rem 1rem;
                /* Espacio alrededor del texto */
                color: $navbar-light-color;
                transition: color 0.3s ease;

                &:hover,
                &:focus {
                    color: $navbar-light-hover-color;
                }

                &.active {
                    color: $navbar-light-active-color;
                    font-weight: 500;
                }
            }

            .dropdown-menu {
                border: none;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                /* Sombra Material Design */
            }
        }

        // Media query para ajustar el padding en dispositivos móviles
        @media (max-width: 991.98px) {

            // Bootstrap's lg breakpoint
            .navbar {
                padding: 0.5rem 1rem;
                height: auto;

                .navbar-collapse {
                    background-color: #fff; // Asegura fondo blanco en mobile
                    padding: 1rem;
                    border-radius: 4px;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                    margin-top: 0.5rem; // Espacio entre la navbar y el menu colapsado
                }
            }
        }
    </style>
    @stack('page-css') {{-- Para estilos específicos de la página --}}
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        {{--  @include('layouts.partials.navbar') --}}
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
            <div class="container">
                {{-- <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a> --}}
                <a class="navbar-brand" href="http://www.agence.com.br/" target="_blank" rel="noopener noreferrer">
                    <img src="inc/logo.gif" alt="Logo Agence" class="img-fluid" loading="lazy"
                        style="max-height: 60px;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto"> <!-- ms-auto para alinear a la derecha -->
                        <li class="nav-item">
                            <a class="nav-link" href="#">Início</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Agence</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Projetos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Administrativo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Comercial</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Financeiro</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Usuário</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Salir</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <!-- Page Content -->
        <main class="container py-4">
            @yield('content')
        </main>

        {{-- @include('layouts.partials.footer') --}}

        <footer class="text-center py-5" style='background-color:rgb(250, 250, 250);'>
            <div class="container px-5">
                <div class="text-black small">
                    <div class="mb-2">&copy; {{ date('Y') }} Your Website 2023. All Rights Reserved.</div>
                </div>
            </div>
        </footer>

    </div>

    @stack('page-js') {{-- Para scripts específicos de la página --}}

</body>

</html>
