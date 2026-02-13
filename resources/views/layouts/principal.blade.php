<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('titulopagina')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset($__env->yieldContent('favicon')) }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.6/css/dataTables.dataTables.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">

    @stack('css')
</head>

<body>

<div class="p-5 text-white text-center fondo">
    <h1>@yield('titulo')</h1>
    <h4>@yield('subtitulo')</h4>
</div>

<div class="sticky-top" style="z-index: 1030;">
    <x-navbar>

    <x-slot name="slot_logo">
        Imagenes\La Ruta Del Sabor_Logo.ico
    </x-slot>

    <x-slot name="slot_titulo">
        La Ruta del Sabor
    </x-slot>

    <x-slot name="slot_eslogan">
        Siempre visible. Siempre a tiempo.
    </x-slot>

    <x-slot name="slot_acciones">
        <span><i class="bi bi-geo-alt"></i> Ciudad de México</span>
    </x-slot>

    <x-slot name="slot_ruta_inicio">{{ route('vista_inicio') }}</x-slot>

    <x-slot name="slot_opciones_buscador">

         <optgroup label="Comidas">
                    <option value="Tacos al Pastor" data-icon="bi-fire">Tacos al Pastor</option>
                    <option value="Cochinita Pibil" data-icon="bi-egg">Cochinita Pibil</option>
                    <option value="Carnitas Artesanales" data-icon="bi-fork-knife">Carnitas Artesanales</option>
                    <option value="Pupusas Tipicas" data-icon="bi-circle">Pupusas Típicas</option>
                </optgroup>

                <optgroup label="Snack’s">
                    <option value="Nachos con queso" data-icon="bi-triangle">Nachos con queso</option>
                    <option value="Papas fritas" data-icon="bi-emoji-smile">Papas fritas</option>
                </optgroup>

                <optgroup label="Postres">
                    <option value="Pastel de tres leches" data-icon="bi-cake">Pastel de tres leches</option>
                    <option value="Flan napolitano" data-icon="bi-cup-hot">Flan napolitano</option>
                </optgroup>

                <optgroup label="Panaderia">
                    <option value="Pan dulce" data-icon="bi-circle-fill">Pan dulce</option>
                    <option value="Conchas tradicionales" data-icon="bi-circle">Conchas tradicionales</option>
                </optgroup>

                <optgroup label="Productos de Temporada">
                    <option value="Rosca de Reyes" data-icon="bi-star">Rosca de Reyes</option>
                    <option value="Pan de muerto" data-icon="bi-flower1">Pan de muerto</option>
                </optgroup>

                <optgroup label="Bebidas">
                    <option value="Agua de horchata" data-icon="bi-droplet">Agua de horchata</option>
                    <option value="Cafe de olla" data-icon="bi-cup-hot-fill">Café de olla</option>
                </optgroup>

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
        <a href="{{route('vista_inicio')}}" class="btn btn-success rounded-pill">Registrarse</a>
        <a href="{{ route('vista_inicio') }}" class="btn btn-warning rounded-pill"><i class="bi bi-cart"></i> Carrito</a>
    </x-slot>

</x-menu>
</div>

@yield('carrusel_pagina_principal')

<div class="container-fluid px-0 py-5 text-center overflow-hidden">
    @yield('contenedor_quienes_somos')
</div>

<div class="container-fluid px-5 py-5 text-center overflow-hidden">
    @yield('contenedor_porque_elegirnos')
</div>

<div class="container-fluid px-0 py-5 text-center overflow-hidden">
    @yield('contenedor_beneficios')
</div>

<div class="container-fluid px-5 py-5 text-center overflow-hidden">
    @yield('contenedor_tipos_servicios')
</div>

<div class="container-fluid px-0 py-5 text-center overflow-hidden">
    @yield('contenedor_comerciantes_destacados')
</div>

<div class="container-fluid px-5 py-5 text-center overflow-hidden">
    @yield('contenedor_estadistica_crecimiento_empresa')
</div>

<footer class="pt-5" style="background: #0A0A0A;">

    <div class="container px-4">

        <div class="row gy-4">

            <div class="col-md-4 text-center text-md-start">
                <div class="d-flex align-items-center mb-2 justify-content-center justify-content-md-start">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-2"
                         style="width: 80px; height: 80px; overflow: hidden; background:#FFC107;">
                        @isset($logo_empresa)
                            @isset($ruta_pagina_principal)
                                <a href="{{ $ruta_pagina_principal }}">
                                    <img src="{{ asset($logo_empresa) }}" alt="Logo {{ $nombre_empresa }}" class="w-100 h-100" style="object-fit: cover;">
                                </a>
                            @else
                                <img src="{{ asset($logo_empresa) }}" alt="Logo {{ $nombre_empresa }}" class="w-100 h-100" style="object-fit: cover;">
                            @endisset
                        @else
                            <i class="bi bi-shop text-white fs-1"></i>
                        @endisset
                    </div>

                    <div>
                        <h4 class="mb-0 fw-bold text-white">
                            <span style="font-family:'Lilita One', cursive;">
                                {{ $nombre_empresa ?? 'Empresa' }}
                            </span>
                        </h4>
                       
@isset($eslogan_empresa)
    <p class="mb-0 text-white small">
        <span style="font-family:'Lilita One', cursive;">
            {{ $eslogan_empresa }}
        </span>
    </p>
@endisset

                    </div>
                </div>

                <p class="text-white small mt-2">
                    {{ $descripcion_empresa ?? 'Plataforma digital' }}
                </p>
            </div>

            <div class="col-md-3">
                <h6 class="fw-bold mb-3 text-white">Enlaces</h6>
                <ul class="list-unstyled small">
                    @isset($enlace_inicio)
                        <li class="mb-2">
                            <a href="{{ $enlace_inicio['url'] }}" class="text-white text-decoration-none link-hover">
                                <i class="bi {{ $enlace_inicio['icono'] }} me-1"></i>
                                {{ $enlace_inicio['texto'] }}
                            </a>
                        </li>
                    @endisset

                    @isset($enlace_ayuda)
                        <li class="mb-2">
                            <a href="{{ $enlace_ayuda['url'] }}" class="text-white text-decoration-none link-hover">
                                <i class="bi {{ $enlace_ayuda['icono'] }} me-1"></i>
                                {{ $enlace_ayuda['texto'] }}
                            </a>
                        </li>
                    @endisset
                </ul>
            </div>

            <div class="col-md-5">
                <h6 class="fw-bold mb-3 text-white">Redes Sociales</h6>
                <ul class="list-unstyled d-flex gap-3">
                    @isset($facebook)
                        <li>
                            <a href="{{ $facebook['url'] }}" target="_blank" class="text-white fs-4 social-hover">
                                <i class="bi {{ $facebook['icono'] }}"></i>
                            </a>
                        </li>
                    @endisset

                    @isset($instagram)
                        <li>
                            <a href="{{ $instagram['url'] }}" target="_blank" class="text-white fs-4 social-hover">
                                <i class="bi {{ $instagram['icono'] }}"></i>
                            </a>
                        </li>
                    @endisset

                    @isset($twitter)
                        <li>
                            <a href="{{ $twitter['url'] }}" target="_blank" class="text-white fs-4 social-hover">
                                <i class="bi {{ $twitter['icono'] }}"></i>
                            </a>
                        </li>
                    @endisset

                    @isset($whatsapp)
                        <li>
                            <a href="{{ $whatsapp['url'] }}" target="_blank" class="text-white fs-4 social-hover">
                                <i class="bi {{ $whatsapp['icono'] }}"></i>
                            </a>
                        </li>
                    @endisset
                </ul>
            </div>

        </div>

        <div class="text-center text-white small mt-4 pb-3 border-top pt-3">
            <i class="bi bi-c-circle me-1"></i>
            {{ date('Y') }}
            <span style="font-family:'Lilita One', cursive;">
                {{ $nombre_empresa ?? 'Empresa' }}
            </span>
            . Todos los derechos reservados.
        </div>

    </div>
</footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
    $(document).ready(function() {

        function formatOption(option) {

            if (!option.id) {
                return option.text;
            }

            if (option.children) {

                let icon = $(option.element).data('icon');

                return $(
                    '<span style="font-weight:bold; font-size:14px;">' +
                    '<i class="bi ' + icon + ' me-2"></i>' +
                    option.text +
                    '</span>'
                );
            }

            let icon = $(option.element).data('icon');

            if (icon) {
                return $(
                    '<span style="padding-left:15px;">' +
                    '<i class="bi ' + icon + ' me-2 text-primary"></i>' +
                    option.text +
                    '</span>'
                );
            }

            return option.text;
        }

        $("#buscador").select2({
            placeholder: "Buscar productos...",
            allowClear: true,
            width: '100%',
            minimumInputLength: 1,
            templateResult: formatOption,
            templateSelection: formatOption
        });

    });
    </script>

</body>
</html>
