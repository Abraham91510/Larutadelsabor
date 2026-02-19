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
    <h1>@yield('subtitulo')</h1>
</div>

<div class="sticky-top" style="z-index: 1030;">
    <x-navbar>

    <x-slot name="slot_logo">
        Imagenes\La Ruta Del Sabor_Logo.ico
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
    <a href="{{ route('vista_inicio') }}" class="btn btn-success rounded-pill">
        <i class="bi bi-person-plus"></i> Registrarse
    </a>
    <a href="{{ route('vista_inicio') }}" class="btn btn-warning rounded-pill">
        <i class="bi bi-cart"></i> Carrito
    </a>
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
                            <a href="{{ $ruta_pagina_principal }}">
                                <img src="{{ asset($logo_empresa) }}" alt="Logo {{ $nombre_empresa }}" class="w-100 h-100" style="object-fit: cover;">
                            </a>
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
                    {{ $descripcion_empresa ?? 'Plataforma digital que conecta clientes con comerciantes ambulantes de comida mediante geolocalización y tecnología segura.' }}
                </p>
            </div>

            
            <div class="col-md-4">
                
                <div class="mb-4">
                    <h6 class="fw-bold mb-3 text-white">Conoce Más</h6>
                    <ul class="list-unstyled">
                        
                        <li>
                            <a href="{{ $menu['inicio']['url'] }}" class="text-white text-decoration-none link-hover">
                                <i class="bi bi-house me-1"></i>
                                {{ $menu['inicio']['texto'] }}
                            </a>
                        </li>

                        
                        <li>
                            <a href="{{ $enlace_registro['url'] }}" class="text-white text-decoration-none link-hover">
                                <i class="bi {{ $enlace_registro['icono'] }} me-1"></i>
                                {{ $enlace_registro['texto'] }}
                            </a>
                        </li>

                        
                        <li>
                            <a href="{{ $enlace_carrito['url'] }}" class="text-white text-decoration-none link-hover">
                                <i class="bi {{ $enlace_carrito['icono'] }} me-1"></i>
                                {{ $enlace_carrito['texto'] }}
                            </a>
                        </li>

                        
                        @isset($enlace_ayuda)
                            <li>
                                <a href="{{ $enlace_ayuda['url'] }}" class="text-white text-decoration-none link-hover">
                                    <i class="bi {{ $enlace_ayuda['icono'] }} me-1"></i>
                                    {{ $enlace_ayuda['texto'] }}
                                </a>
                            </li>
                        @endisset

                        
                        <li>
                            <a href="{{ $menu['contacto']['url'] }}" class="text-white text-decoration-none link-hover">
                                <i class="bi {{ $menu['contacto']['icono'] }} me-1"></i>
                                {{ $menu['contacto']['texto'] }}
                            </a>
                        </li>
                    </ul>
                </div>

                
                <div>
                    <h6 class="fw-bold mb-3 text-white">Categorías</h6>
                    <ul class="list-unstyled">
                        @foreach ($menu['categorias']['items'] as $categoria)
                            <li>
                                <a href="{{ $categoria['url'] }}" class="text-white text-decoration-none link-hover">
                                    <i class="bi {{ $categoria['icono'] }} me-1"></i>
                                    {{ $categoria['texto'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        
            <div class="col-md-4">
                
                <div class="mb-4">
                    <h6 class="fw-bold mb-3 text-white">Nuestros Comerciantes</h6>
                    <ul class="list-unstyled">
                        @foreach ($menu['comerciantes']['items'] as $comerciante)
                            <li>
                                <a href="{{ $comerciante['url'] }}" class="text-white text-decoration-none link-hover">
                                    <i class="bi {{ $comerciante['icono'] }} me-1"></i>
                                    {{ $comerciante['texto'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    <h6 class="fw-bold mb-3 text-white">Aprende a usar</h6>
                    <ul class="list-unstyled">
                        @foreach ($menu['como_funciona']['items'] as $item)
                            <li>
                                <a href="{{ $item['url'] }}" class="text-white text-decoration-none link-hover">
                                    <i class="bi {{ $item['icono'] }} me-1"></i>
                                    {{ $item['texto'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>

        <div class="text-center">
            <h6 class="fw-bold text-white">Redes Sociales</h6>
            <ul class="list-unstyled d-flex justify-content-center gap-3">
                @foreach (['facebook', 'instagram', 'twitter', 'whatsapp', 'linkedin', 'github', 'telegram', 'youtube', 'twitch', 'discord', 'snapchat', 'pinterest', 'reddit', 'tiktok'] as $social)
                    @isset($$social)
                        <li>
                            <a href="{{ $$social['url'] }}" target="_blank" class="text-white fs-4 social-hover">
                                <i class="fa-brands {{ $$social['icono'] }}"></i>
                            </a>
                        </li>
                    @endisset
                @endforeach
            </ul>
        </div>

        <div class="text-center text-white small mt-4 pb-3 border-top pt-3">
            <i class="bi bi-c-circle me-1"></i>
            {{ date('Y') }} <span style="font-family:'Lilita One', cursive;">{{ $nombre_empresa ?? 'Empresa' }}</span> . Todos los derechos reservados.
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


<script>
document.addEventListener("DOMContentLoaded", async function () {

    const ciudadTexto = document.getElementById("ciudadTexto");
    const ubicacionDiv = document.getElementById("ubicacion");
    const inputCPDiv = document.getElementById("inputCP");
    const codigoInput = document.getElementById("codigoPostalInput");
    const botonGuardar = document.getElementById("guardarCP");
    const mensajeError = document.getElementById("mensajeError");
    const mensajePais = document.getElementById("mensajePais");

    let paisCodigo = "mx";

    try {
        const ipData = await fetch("https://ipapi.co/json/");
        const ipJson = await ipData.json();

         paisCodigo = ipJson.country_code?.toLowerCase() || "mx";
        paisNombre = ipJson.country_name || "México";
        const ciudad = ipJson.city || ipJson.region || "Tu ubicación";
        const cp = ipJson.postal || "";

        ciudadTexto.textContent = cp ? `${ciudad}, ${cp}` : ciudad;

        mensajePais.textContent = `Introduce un código postal en ${paisNombre}`;


        localStorage.setItem("ciudadUsuario", ciudad);
        if (cp) localStorage.setItem("codigoPostal", cp);
        if (cp) codigoInput.value = cp;

    } catch {
        ciudadTexto.textContent = "Tu ubicación";
    }

    ubicacionDiv.addEventListener("click", function(e) {
        e.stopPropagation();
        inputCPDiv.style.display = inputCPDiv.style.display === "none" ? "block" : "none";
        codigoInput.focus();
        mensajeError.style.display = "none";
    });

    document.addEventListener("click", function() {
        inputCPDiv.style.display = "none";
    });

    codigoInput.addEventListener("input", function() {
        mensajeError.style.display = "none";
    });

    botonGuardar.addEventListener("click", async function(e) {
        e.stopPropagation();
        mensajeError.style.display = "none";

        const cp = codigoInput.value.trim();

        if (!/^[A-Za-z0-9\s-]{4,10}$/.test(cp)) {
            mensajeError.textContent = "Código postal inválido.";
            mensajeError.style.display = "block";
            return;
        }

        try {
            const response = await fetch(
                `https://nominatim.openstreetmap.org/search?postalcode=${cp}&countrycodes=${paisCodigo}&format=json&addressdetails=1&limit=1`
            );
            const data = await response.json();

            if (data.length > 0) {
                const address = data[0].address;
                const ciudad =
                    address.city ||
                    address.town ||
                    address.village ||
                    address.county ||
                    address.state ||
                    "Ubicación encontrada";

                ciudadTexto.textContent = `${ciudad}, ${cp}`;
                localStorage.setItem("ciudadUsuario", ciudad);
                localStorage.setItem("codigoPostal", cp);
                inputCPDiv.style.display = "none";

            } else {
                mensajeError.textContent = "Código postal no encontrado en tu país.";
                mensajeError.style.display = "block";
            }

        } catch (error) {
            mensajeError.textContent = "Error al buscar el código postal.";
            mensajeError.style.display = "block";
        }

    });

});
</script>

<script>
    const cuadro = document.getElementById('inputCP');
    const input = document.getElementById('codigoPostalInput');
    const errorDiv = document.getElementById('mensajeError');

    function toggleCuadro(event) {
        
        event.stopPropagation();
        const estaVisible = cuadro.style.display === 'block';
        cuadro.style.display = estaVisible ? 'none' : 'block';
    }

    cuadro.addEventListener('click', function(event) {
        event.stopPropagation();
    });

    function procesarCP() {
        const cp = input.value.trim();
        
        if (cp === "") {
            errorDiv.innerText = "Por favor, escribe un código.";
            errorDiv.style.display = "block";
        } else {
            errorDiv.style.display = "none";
            alert("Código postal guardado: " + cp);
        }
    }

    document.addEventListener('click', function() {
        cuadro.style.display = 'none';
    });
</script>

</body>
</html>
