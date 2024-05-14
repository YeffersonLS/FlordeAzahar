<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{'Flor de Azahar'}}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- CSS -->
    @if (env('APP_ENV') == "local")
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @else
        <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    @endif
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        #news-list li:not(:first-child) {
            display: none;
        }
    </style>
    @yield('css')

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>

    @if (session('mensaje'))
        <div class="alert alert-success alert-dismissable">
            {{ session('mensaje') }}
        </div>
    @endif

    <div class="header-top header-top-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6">
                    <div class="header-info">
                        <ul>
                            <li><i class="fas fa-phone"></i> <a href="https://wa.link/2sgb9s">229 667 4807</a></li>
                            <li><i class="fas fa-map-marker-alt"></i><a href="https://maps.app.goo.gl/W8efXpjTtPCsK75U9" target="_blank" rel="noopener noreferrer"> C. 5 de Mayo 805-Local B, Centro, 95100 Tierra Blanca, Ver.</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="text-center">
                        <div id="news-flash" class="d-inline-block">
                            <ul id="news-list">
                                <li>Los mejores Helados <a href="/productos">Ver mas</a></li>
                                <li>La mejor Calidad</li>
                                <li>Se parte de la Familia <a href="#">Unete</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-pink shadow-sm"> <!-- Cambiar la clase a navbar-pink -->
            <div class="container">
                @if (env('APP_ENV') == "local")
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="rounded-circle" src="{{ asset('vendor/adminlte/dist/img/AdminLTELogo.svg') }}" alt="Logo" style="width: 40px; height: 40px;">
                    {{ 'Flor de Azahar' }}
                </a>
            @else
            <a class="navbar-brand" href="{{ url('/') }}">
                <img class="rounded-circle" src="{{ asset('public/vendor/adminlte/dist/img/AdminLTELogo.svg') }}" alt="Logo" style="width: 80px; height: 80px;">
                {{ 'Flor de Azahar' }}
            </a>
            @endif

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    {{-- <ul class="navbar-nav me-auto">

                    </ul> --}}

                    <!-- Right Side Of Navbar -->
                    <div class="d-flex justify-content-center align-items-center mx-auto">
                        <form class="d-flex" action="{{ route('buscar') }}" method="GET">
                            <input class="form-control me-2" type="search" name="query" placeholder="Buscar" aria-label="Search">
                            <button class="btn btn-outline-light" type="submit">Buscar</button>
                        </form>
                    </div>

                    {{-- <!-- Right Side Of Navbar --> --}}
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fas fa-user"></i> <!-- Icono de usuario -->
                                    {{ Auth::user()->sys01name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                                    @if (Auth::user()->sys01admin == true)
                                        <a class="dropdown-item" href="/admin">Panel de control</a>
                                    @endif

                                    {{-- @if (App\Models\T11combosagendados::count() >= 1) --}}
                                        <a class="dropdown-item" href="/combosAgendados">Combos Agendados</a>
                                    {{-- @endif --}}
                                </div>
                            </li>
                        @endguest
                    </ul>
                    <a href="/monedero" style="text-decoration: none; color: inherit;">
                        <span style="font-size: 1.2em;">💰</span> Monedero
                    </a>

                </div>
            </div>
        </nav>
    </div>

    <nav class="menu">
        <ul>
            <li><a href="/categorias">Ver Categorías</a></li>
            <li><a href="/productos">Productos</a></li>
            <li><a href="/combos">Combos</a></li>
            <li><a href="/blogs">BLOG</a></li>
            <li><a href="/tiendas">Tiendas</a></li>
            <li><a href="/contacto">Contacto</a></li>
            <li><a href="/nosotros">Nosotros</a></li>
        </ul>
    </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

<footer class="footer">
    <div class="header-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3>Contacto</h3>
                    <ul>
                        <li><i class="fas fa-phone"></i> Teléfono: 229 667 4807</li>
                        <li><i class="fas fa-envelope"></i> Correo electrónico: flor@example.com</li>
                        <li><i class="fas fa-map-marker-alt"></i> Dirección: C. 5 de Mayo 805-Local B, Centro, 95100 Tierra Blanca, Ver.</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h3>Síguenos</h3>
                    <ul class="list-inline">
                        <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                        {{-- <li><a href="#"><i class="fab fa-linkedin"></i></a></li> --}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-footer text-center">
        <div class="container">
            <p>&copy; 2024 Flor de Azahar. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>

@yield('js')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Selecciona la lista de noticias
        var newsList = document.getElementById('news-list');

        // Obtiene todos los elementos <li> de la lista
        var newsItems = newsList.getElementsByTagName('li');

        // Inicializa el índice actual del elemento de la lista
        var currentIndex = 0;

        // Función para cambiar el elemento de la lista cada 10 segundos
        setInterval(function() {
            // Oculta el elemento actual
            newsItems[currentIndex].style.display = 'none';

            // Incrementa el índice o reinicia si se llega al final
            currentIndex = (currentIndex + 1) % newsItems.length;

            // Muestra el nuevo elemento
            newsItems[currentIndex].style.display = 'block';
        }, 5000); // 5 segundos
    });
</script>

</html>
