<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    @stack('page-meta')

    <title>@yield('title', 'Mi Aplicación')</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Opcional: tu CSS personalizado -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    @stack('page-css')
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">MiApp</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"><span
                    class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Características</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contacto</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container my-5">
        @yield('content')
    </main>

    <footer class="bg-light text-center py-3 mt-auto">
        <div class="container">
            <small>© 2025 Mi Aplicación. Todos los derechos reservados.</small>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle (incluye Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Opcional: tu JS personalizado -->
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('page-js')

</body>

</html>
