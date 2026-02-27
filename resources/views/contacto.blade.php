<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ $titulopagina }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset($generales['logo_empresa'] ?? 'Imagenes/La Ruta Del Sabor_Logo.ico') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.6/css/dataTables.dataTables.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    <style>
        .fondo{
            background: #2D9F4F;
        }    
        
        .img-responsive{
            width: 100%;
            height:100%;
        }
        
        body {
            font-family: 'Nunito', sans-serif !important;
        }

        h1{
        font-family: 'Lilita One', cursive !important;
        }
        h2, h3, h4, h5, h6 {
        font-family: 'Poppins', sans-serif !important;
        font-weight: 700;       
        }


        .social-hover:hover,
        .link-hover:hover {
            color: #FFC107 !important;
            transform: scale(1.2);
            transition: all 0.3s ease;
        }

    </style>
</head>

<body>

<div class="p-5 text-white text-center fondo">
    <h1>{{ $generales['nombre_empresa'] }}</h1>
    <h2>{{ $generales['eslogan_empresa'] }}</h2>
</div>

<div class="sticky-top" style="z-index: 1030;">
    <x-navbar>
        <x-slot name="slot_logo">{{ $generales['logo_empresa'] }}</x-slot>
        <x-slot name="slot_ruta_inicio">{{ $conoceMas['enlace_inicio']['url'] }}</x-slot>

        <x-slot name="slot_opciones_buscador">
            @foreach($buscador['DatosBuscador'] as $categoria => $opciones)
                <optgroup label="{{ $categoria }}">
                    @foreach($opciones as $opcion)
                        <option value="{{ $opcion['texto'] }}" data-icon="{{ $opcion['icono'] }}">
                            {{ $opcion['texto'] }}
                        </option>
                    @endforeach
                </optgroup>
            @endforeach
        </x-slot>
    </x-navbar>

    <x-menu>
        <x-slot name="slot_inicio_texto">{{ $conoceMas['enlace_inicio']['texto'] }}</x-slot>
        <x-slot name="slot_inicio_url">{{ $conoceMas['enlace_inicio']['url'] }}</x-slot>

        <x-slot name="slot_categorias_titulo">{{ $categorias['titulo'] }}</x-slot>
        <x-slot name="slot_categorias_items">
            @foreach($categorias['items'] as $item)
                <li><a class="dropdown-item" href="{{ $item['url'] }}">{{ $item['texto'] }}</a></li>
            @endforeach
        </x-slot>

        <x-slot name="slot_comerciantes_titulo">{{ $comerciantes['titulo'] }}</x-slot>
        <x-slot name="slot_comerciantes_items">
            @foreach($comerciantes['items'] as $item)
                <li><a class="dropdown-item" href="{{ $item['url'] }}">{{ $item['texto'] }}</a></li>
            @endforeach
        </x-slot>

        <x-slot name="slot_como_funciona_titulo">{{ $aprende['titulo'] }}</x-slot>
        <x-slot name="slot_como_funciona_items">
            @foreach($aprende['items'] as $item)
                <li><a class="dropdown-item" href="{{ $item['url'] }}">{{ $item['texto'] }}</a></li>
            @endforeach
        </x-slot>

        <x-slot name="slot_contacto_texto">{{ $conoceMas['enlace_contacto']['texto'] }}</x-slot>
        <x-slot name="slot_contacto_url">{{ $conoceMas['enlace_contacto']['url'] }}</x-slot>

        <x-slot name="slot_acciones">
            <a href="{{ $conoceMas['enlace_registro']['url'] }}" class="btn btn-success rounded-pill">
                <i class="{{ $conoceMas['enlace_registro']['icono'] }}"></i> {{ $conoceMas['enlace_registro']['texto'] }}
            </a>
            <a href="{{ $conoceMas['enlace_carrito']['url'] }}" class="btn btn-warning rounded-pill">
                <i class="{{ $conoceMas['enlace_carrito']['icono'] }}"></i> {{ $conoceMas['enlace_carrito']['texto'] }}
            </a>
        </x-slot>
    </x-menu>
</div>

<div class="container-fluid px-5 py-5 text-center overflow-hidden">
    <div class="text-center mb-5">
        <h1 class="fw-bold">Contacto</h1>
    </div>
</div>


<footer class="pt-5" style="background: #0A0A0A;">
    <div class="container px-4">
        <div class="row gy-4">

            
            <div class="col-md-4 text-center text-md-start">
                <div class="d-flex align-items-center mb-2 justify-content-center justify-content-md-start">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-2"
                         style="width: 80px; height: 80px; overflow: hidden; background:#FFC107;">
                        @isset($generales['logo_empresa'])
                            <a href="{{ route('inicio') }}">
                                <img src="{{ asset($generales['logo_empresa']) }}" alt="Logo {{ $generales['nombre_empresa'] }}" class="w-100 h-100" style="object-fit: cover;">
                            </a>
                        @else
                            <i class="bi bi-shop text-white fs-1"></i>
                        @endisset
                    </div>
                    <div>
                        <h4 class="mb-0 fw-bold text-white" style="font-family:'Lilita One', cursive;">
                            {{ $generales['nombre_empresa'] }}
                        </h4>
                        <p class="mb-0 text-white small" style="font-family:'Lilita One', cursive;">
                            {{ $generales['eslogan_empresa'] }}
                        </p>
                    </div>
                </div>
                <p class="text-white small mt-2">{{ $generales['descripcion_empresa'] }}</p>
            </div>

            
            <div class="col-md-2">
                <h6 class="fw-bold mb-3 text-white">{{ $conoceMas['titulo'] ?? 'Conoce Más' }}</h6>
                <ul class="list-unstyled">
                    @foreach($conoceMas as $key => $link)
                        @if(str_starts_with($key,'enlace'))
                            <li>
                                <a href="{{ $link['url'] }}" class="text-white text-decoration-none link-hover">
                                    <i class="{{ $link['icono'] }} me-1"></i>{{ $link['texto'] }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

            
            <div class="col-md-2">
                <h6 class="fw-bold mb-3 text-white">{{ $categorias['titulo'] }}</h6>
                <ul class="list-unstyled">
                    @foreach($categorias['items'] as $item)
                        <li><a href="{{ $item['url'] }}" class="text-white text-decoration-none link-hover">
                            <i class="bi {{ $item['icono'] }} me-1"></i>{{ $item['texto'] }}
                        </a></li>
                    @endforeach
                </ul>
            </div>

            
            <div class="col-md-2">
                <h6 class="fw-bold mb-3 text-white">{{ $comerciantes['titulo'] }}</h6>
                <ul class="list-unstyled">
                    @foreach($comerciantes['items'] as $item)
                        <li><a href="{{ $item['url'] }}" class="text-white text-decoration-none link-hover">
                            <i class="bi {{ $item['icono'] }} me-1"></i>{{ $item['texto'] }}
                        </a></li>
                    @endforeach
                </ul>
            </div>

            
            <div class="col-md-2">
                <h6 class="fw-bold mb-3 text-white">{{ $aprende['titulo'] }}</h6>
                <ul class="list-unstyled">
                    @foreach($aprende['items'] as $item)
                        <li><a href="{{ $item['url'] }}" class="text-white text-decoration-none link-hover">
                            <i class="bi {{ $item['icono'] }} me-1"></i>{{ $item['texto'] }}
                        </a></li>
                    @endforeach
                </ul>
            </div>

        </div>

        
        <div class="text-center mt-4">
            <h6 class="fw-bold text-white">Redes Sociales</h6>
            <ul class="list-unstyled d-flex justify-content-center gap-3">
                @foreach(['facebook','instagram','x','whatsapp','youtube','tiktok'] as $red)
                    @isset($redes[$red])
                        <li>
                            <a href="{{ $redes[$red]['url'] }}" target="_blank" class="text-white fs-4 social-hover">
                                <i class="fa-brands {{ $redes[$red]['icono'] }}"></i>
                            </a>
                        </li>
                    @endisset
                @endforeach
            </ul>
        </div>

        
        <div class="text-center text-white small mt-4 pb-3 border-top pt-3">
            <i class="{{ $generales['derechos_reservados_empresa']['icono'] }} me-1"></i>
            {{ $generales['derechos_reservados_empresa']['anio'] }}
            <span style="font-family:'Lilita One', cursive;">{{ $generales['nombre_empresa'] }}</span>.
            {{ $generales['derechos_reservados_empresa']['texto'] }}
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
        }
    }

    document.addEventListener('click', function() {
        cuadro.style.display = 'none';
    });
</script>

<script src="https://cdn.userway.org/widget.js" data-account="SwcLPv3GeL"></script>

</body>
</html>
