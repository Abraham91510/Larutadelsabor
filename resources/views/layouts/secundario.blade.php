<x-header
    :titulopagina="$titulopagina"
    :favicon="$generales['logo_empresa']"
    :titulo="$generales['nombre_empresa']"
    :subtitulo="$generales['eslogan_empresa']"
/>

<div class="sticky-top" style="z-index: 1030;">
    <x-navbar>
        <x-slot name="slot_logo">{{ $generales['logo_empresa'] }}</x-slot>
        <x-slot name="slot_ruta_inicio">{{ $conoceMas['enlace_inicio']['url'] }}</x-slot>

       <x-slot name="slot_opciones_buscador">

@foreach($buscador['DatosBuscador'] ?? [] as $categoria => $opciones)

<optgroup label="{{ $categoria }}">

    @foreach($opciones as $opcion)

        <option
            value="{{ $opcion['texto'] }}"
            data-icon="{{ $opcion['icono'] }}"
            data-url="{{ $opcion['url'] }}">

            {{ $opcion['texto'] }}

        </option>

    @endforeach

</optgroup>

@endforeach

</x-slot>

    </x-navbar>

    <x-menu :menu="$menu" :categorias="$categorias">

    {{-- INICIO --}}
    <x-slot name="slot_inicio_texto">
        {{ $conoceMas['enlace_inicio']['texto'] }}
    </x-slot>

    <x-slot name="slot_inicio_url">
        {{ $conoceMas['enlace_inicio']['url'] }}
    </x-slot>

    {{-- CATEGORÍAS --}}
    <x-slot name="slot_categorias_titulo">
        {{ $categorias['titulo'] }}
    </x-slot>

    <x-slot name="slot_categorias_items">
        @foreach($categorias['items'] as $item)
            <li>
                <a class="dropdown-item" href="{{ $item['url'] }}">
                    {{ $item['texto'] }}
                </a>
            </li>
        @endforeach
    </x-slot>

    {{-- 🔥 MENÚ DINÁMICO DESDE BD --}}
    @foreach($menu as $opcion)

        @if($opcion->slug != 'categorias')

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                    {{ $opcion->nombre }}
                </a>

                <ul class="dropdown-menu">
                    @foreach($opcion->subopciones as $sub)
                        <li>
                            <a class="dropdown-item" href="{{ $sub->url }}">
                                <i class="bi {{ $sub->icono }} me-2"></i>
                                {{ $sub->nombre }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>

        @endif

    @endforeach

    {{-- CONTACTO --}}
    <x-slot name="slot_contacto_texto">
        {{ $conoceMas['enlace_contacto']['texto'] }}
    </x-slot>

    <x-slot name="slot_contacto_url">
        {{ $conoceMas['enlace_contacto']['url'] }}
    </x-slot>

    {{-- BOTONES --}}
    <x-slot name="slot_acciones">
        <a href="{{ $conoceMas['enlace_registro']['url'] }}" class="btn btn-success rounded-pill">
            <i class="{{ $conoceMas['enlace_registro']['icono'] }}"></i>
            {{ $conoceMas['enlace_registro']['texto'] }}
        </a>

        <a href="{{ $conoceMas['enlace_carrito']['url'] }}" class="btn btn-warning rounded-pill">
            <i class="{{ $conoceMas['enlace_carrito']['icono'] }}"></i>
            {{ $conoceMas['enlace_carrito']['texto'] }}
        </a>
    </x-slot>

</x-menu>
</div>

<!-- Contenedor de contenido -->
    <div class="container-fluid px-5 py-5 text-center overflow-hidden">
        @yield('contenedor_contenido')
    </div>

<x-footer 
    :generales="$generales"
    :conoceMas="$conoceMas"
    :categorias="$categorias"
    :menu="$menu"
    :redes="$redes"
/>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script>

$(document).ready(function() {

function formatOption(option) {

    if (!option.id) {
        return option.text;
    }

    let icon = $(option.element).data('icon');

    if(icon){

        return $(
            '<span>' +
            '<i class="bi '+icon+' me-2 text-primary"></i>' +
            option.text +
            '</span>'
        );

    }

    return option.text;

}

function formatSelection(option){

    if (!option.id) {
        return option.text;
    }

    let icon = $(option.element).data('icon');

    if(icon){

        return $(
            '<span>' +
            '<i class="bi '+icon+' me-1"></i>' +
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

    language:{
        inputTooShort:function(){
            return "Escribe al menos un carácter";
        },
        noResults:function(){
            return "No se encontraron resultados";
        },
        searching:function(){
            return "Buscando...";
        }
    },

    templateResult: formatOption,
    templateSelection: formatSelection,
    escapeMarkup:function(m){return m;}

});

$("#buscador").on('select2:select', function(e){

    const url=$(e.params.data.element).data('url');

    if(url){
        window.location.href=url;
    }

});

});

</script>

</script>

    <!-- Gestión de Código Postal -->
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
                const paisNombre = ipJson.country_name || "México";
                const ciudad = ipJson.city || ipJson.region || "Tu ubicación";
                const cp = ipJson.postal || "";
                ciudadTexto.textContent = cp ? `${ciudad}, ${cp}` : ciudad;
                mensajePais.textContent = `Introduce un código postal en ${paisNombre}`;
                localStorage.setItem("ciudadUsuario", ciudad);

                if (cp) {
                    localStorage.setItem("codigoPostal", cp);
                    codigoInput.value = cp;
                    document.getElementById("cpHidden").value = cp;
                }
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
                    const response = await fetch(`https://nominatim.openstreetmap.org/search?postalcode=${cp}&countrycodes=${paisCodigo}&format=json&addressdetails=1&limit=1`);
                    const data = await response.json();

                    if (data.length > 0) {
                        const address = data[0].address;
                        const ciudad = address.city || address.town || address.village || address.county || address.state || "Ubicación encontrada";
                        ciudadTexto.textContent = `${ciudad}, ${cp}`;
                        localStorage.setItem("ciudadUsuario", ciudad);
                        localStorage.setItem("codigoPostal", cp);
                        document.getElementById("cpHidden").value = cp;
                        document.getElementById("formCP").submit();
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

    <!-- UserWay Widget -->
    <script src="https://cdn.userway.org/widget.js" data-account="SwcLPv3GeL"></script>

    <!-- Formulario oculto de CP -->
    <form id="formCP" method="GET" style="display:none;">
        <input type="hidden" name="cp" id="cpHidden" value="{{ request('cp') }}">
    </form>


<script>
document.addEventListener('DOMContentLoaded', function(){

    const slider = document.getElementById("precioRange");
    const precioValor = document.getElementById("precioValor");

    if(!slider || !precioValor) return;

    // valor inicial con centavos
    precioValor.innerHTML = "$" + parseFloat(slider.value).toFixed(2);

    slider.oninput = function(){
        precioValor.innerHTML = "$" + parseFloat(this.value).toFixed(2);
    }

});
</script>



<script>
document.addEventListener('DOMContentLoaded', function(){

    const categoriaSelect = document.getElementById('categoria');
    const subcategoriaSelect = document.getElementById('subcategoria');

    // evitar errores si no existe
    if(!categoriaSelect || !subcategoriaSelect){
        return;
    }

    categoriaSelect.addEventListener('change', function(){

        let categoria = this.value;

        subcategoriaSelect.innerHTML = '<option value="">Cargando...</option>';

        if(categoria === ""){
            subcategoriaSelect.innerHTML = '<option value="">Todas</option>';
            return;
        }

        fetch(`/subcategorias/${categoria}`)
        .then(response => {
            if(!response.ok){
                throw new Error("Error en servidor");
            }
            return response.json();
        })
        .then(data => {

            subcategoriaSelect.innerHTML = '<option value="">Todas</option>';

            if(data.length === 0){
                subcategoriaSelect.innerHTML += '<option value="">Sin resultados</option>';
            }

            data.forEach(sub => {
                subcategoriaSelect.innerHTML += `
                    <option value="${sub.id}">${sub.nombre}</option>
                `;
            });

        })
        .catch(error => {
            console.error(error);
            subcategoriaSelect.innerHTML = '<option value="">Error al cargar</option>';
        });

    });

});
</script>

<script>
document.addEventListener('DOMContentLoaded', function(){

    const opciones = document.querySelectorAll('.rating-opcion');
    const input = document.getElementById('ratingInput');
    const texto = document.getElementById('ratingTexto');

    if(!input || !texto) return;

    function pintarEstrellas(valor){
        let html = '';

        if(valor === ''){
            html = texto.dataset.default;
        } else {
            for(let i = 1; i <= 5; i++){
                html += `<i class="bi ${i <= valor ? 'bi-star-fill text-warning' : 'bi-star text-muted'}"></i>`;
            }
        }

        texto.innerHTML = html;
    }

    // estado inicial (cuando recarga)
    pintarEstrellas(input.value);

    opciones.forEach(op => {
        op.addEventListener('click', function(e){
            e.preventDefault();

            const value = this.dataset.value;
            input.value = value;

            pintarEstrellas(value);
        });
    });

});
</script>

</body>
</html>