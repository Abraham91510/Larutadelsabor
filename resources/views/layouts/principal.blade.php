<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('titulopagina')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.6/css/dataTables.dataTables.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    @stack('css')
</head>

<body>

<div class="p-5 text-white text-center fondo">
    <h1>@yield('titulo')</h1>
    <h4>@yield('subtitulo')</h4>
</div>


<body>

    <x-navbar>

    <x-slot name="slot_logo">
        Imagenes\La Ruta Del Sabor_Logo.png
    </x-slot>

    <x-slot name="slot_titulo">
        La Ruta del Sabor
    </x-slot>

    <x-slot name="slot_eslogan">
        Siempre visible. Siempre a tiempo.
    </x-slot>

    <x-slot name="slot_placeholder">
        Buscar productos o comerciantes...
    </x-slot>

    <x-slot name="slot_acciones">
        <span><i class="bi bi-geo-alt"></i> Ciudad de México</span>
        <a href="{{route('vista_inicio')}}" class="btn btn-success rounded-pill">Registrarse</a>
    </x-slot>

</x-navbar>

<x-menu>

    <x-slot name="slot_inicio_texto">Inicio</x-slot>
    <x-slot name="slot_inicio_url">{{ route('vista_inicio') }}</x-slot>

    <x-slot name="slot_categorias_titulo">Categorías</x-slot>
    <x-slot name="slot_categorias_items">
        <li><a class="dropdown-item" href="{{ route('vista_inicio') }}">Comidas</a></li>
        <li><a class="dropdown-item" href="{{ route('vista_inicio') }}">Snack’s</a></li>
        <li><a class="dropdown-item" href="{{ route('vista_inicio') }}">Postres</a></li>
        <li><a class="dropdown-item" href="{{ route('vista_inicio') }}">Panadería</a></li>
        <li><a class="dropdown-item" href="{{ route('vista_inicio') }}">Productos de temporada</a></li>
        <li><a class="dropdown-item" href="{{ route('vista_inicio') }}">Bebidas</a></li>
    </x-slot>

    <x-slot name="slot_comerciantes_titulo">Nuestros Comerciantes</x-slot>
    <x-slot name="slot_comerciantes_items">
        <li><a class="dropdown-item" href="{{ route('vista_inicio') }}">Cerca de mí</a></li>
        <li><a class="dropdown-item" href="{{ route('vista_inicio') }}">Mejor calificados</a></li>
        <li><a class="dropdown-item" href="{{ route('vista_inicio') }}">Nuevos</a></li>
    </x-slot>

    <x-slot name="slot_como_funciona_titulo">Aprende a usar</x-slot>
    <x-slot name="slot_como_funciona_items">
        <li><a class="dropdown-item" href="{{ route('vista_inicio') }}">Clientes</a></li>
        <li><a class="dropdown-item" href="{{ route('vista_inicio') }}">Comerciantes</a></li>
        <li><a class="dropdown-item" href="{{ route('vista_inicio') }}">Pagos</a></li>
    </x-slot>

    <x-slot name="slot_contacto_texto">Contacto</x-slot>
    <x-slot name="slot_contacto_url">{{ route('vista_inicio') }}</x-slot>

    <x-slot name="slot_acciones">
        <a href="{{ route('vista_inicio') }}" class="text-warning fw-bold text-decoration-none">Únete</a>
        <a href="{{ route('vista_inicio') }}" class="btn btn-warning rounded-pill"><i class="bi bi-cart"></i> Carrito</a>
    </x-slot>

</x-menu>

@yield('carrusel')

<div class="container-fluid px-0 py-5 text-center">
    @yield('contenedor1')
</div>

<div class="container-fluid px-0 py-5 text-center">
    @yield('contenedor2')
</div>

<div class="container-fluid px-0 py-5 text-center">
    @yield('contenedor3')
</div>

<div class="container-fluid px-0 py-5 text-center">
    @yield('contenedor4')
</div>

<div class="container-fluid px-0 py5 text-center">
    @yield('contenedor5')
</div>

<div class="container-fluid px-0 py-5 text-center">
    @yield('contenedor6')
</div>

<footer class="pt-5"
        style="background: radial-gradient(circle at top, #F9CA24, #F9CA24); color:#000;">

    <div class="container px-4">

        <div class="row gy-4">

            <div class="col-md-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center me-2"
                         style="width: 40px; height: 40px;">
                        <i class="bi bi-shop text-dark"></i>
                    </div>
                    <h5 class="mb-0 fw-bold text-dark">
                        {{ $nombre_empresa ?? 'Empresa' }}
                    </h5>
                </div>

                <p class="text-dark small">
                    Plataforma digital que conecta clientes con comerciantes de comida
                    mediante geolocalización y tecnología segura.
                </p>

                <p class="fw-semibold fst-italic text-dark">
                    "{{ $actividad ?? 'Sistema web' }}"
                </p>
            </div>
            
            <div class="col-md-3">
                <h6 class="fw-bold mb-3 text-dark">Enlaces</h6>
                <ul class="list-unstyled small">
                    <li>
                        <i class="bi bi-house me-1 text-dark"></i>
                        <a href="{{ route('inicio') }}" class="text-dark text-decoration-none">
                            Inicio
                        </a>
                    </li>
                    <li>
                        <i class="bi bi-question-circle me-1 text-dark"></i>
                        <a href="#" class="text-dark text-decoration-none">
                            Ayuda
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-md-5">
                <h6 class="fw-bold mb-3 text-dark">Información</h6>

                <ul class="list-unstyled small text-dark">
                    <li class="mb-2">
                        <i class="bi bi-person-fill me-2 text-dark"></i>
                        <strong>Autor:</strong> {{ $nombre }}
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-calendar-event me-2 text-dark"></i>
                        <strong>Fecha:</strong> {{ $fecha }}
                    </li>
                    <li>
                        <i class="bi bi-file-earmark-text me-2 text-dark"></i>
                        <strong>Actividad:</strong> {{ $actividad }}
                    </li>
                </ul>
            </div>

        </div>

        <div class="text-center text-dark small mt-4 pb-3 border-top pt-3">
            © {{ date('Y') }} {{ $nombre_empresa }}. Todos los derechos reservados.
        </div>

    </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
