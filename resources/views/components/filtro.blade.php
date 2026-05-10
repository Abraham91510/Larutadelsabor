@props(['subcategorias','precio_min','precio_max'])

<form method="GET" action="{{ route('productos') }}" class="p-3 bg-white rounded shadow-sm">

  

    <!-- CATEGORÍA -->
    <label class="fw-bold mb-1">Categoría</label>
    <select id="categoria" name="categoria" class="form-select mb-3">
    <option value="" {{ request('categoria') == '' ? 'selected' : '' }}>Todas</option>
    
    {{-- Revisa que estos valores coincidan con los slugs en tu BD --}}
    <option value="comida" {{ request('categoria') == 'comida' ? 'selected' : '' }}>Comida</option>
    <option value="snack" {{ request('categoria') == 'snack' ? 'selected' : '' }}>Snack's</option>
    <option value="postres" {{ request('categoria') == 'postres' ? 'selected' : '' }}>Postres</option>
    <option value="panaderia" {{ request('categoria') == 'panaderia' ? 'selected' : '' }}>Panadería</option>
    <option value="bebidas" {{ request('categoria') == 'bebidas' ? 'selected' : '' }}>Bebidas</option>
    <option value="producto_temporada" {{ request('categoria') == 'producto_temporada' ? 'selected' : '' }}>
    Productos de temporada
</option>
</select>

    <!-- SUBCATEGORÍA -->
    <label class="fw-bold mb-1">Subcategoría</label>
    <select id="subcategoria" name="subcategoria" class="form-select mb-3">
    <option value="">Todas</option>

    @foreach($subcategorias as $sub)
        <option value="{{ $sub->id }}" {{ request('subcategoria') == $sub->id ? 'selected' : '' }}>
            {{ $sub->nombre }}
        </option>
    @endforeach
</select>

    <!-- PRECIO -->
    <label class="fw-bold mb-1">Precio máximo</label>
    <input 
        type="range"
        id="precioRange"
        name="precio_max"
        min="{{ $precio_min }}"
        max="{{ $precio_max }}"
        step="0.01"
        value="{{ request('precio_max', $precio_max) }}"
        class="form-range"
    >

    <div class="text-center mb-3">
        Hasta: <strong id="precioValor"></strong>
    </div>

    <!-- ⭐ CALIFICACIÓN (FUSIONADO + MEJOR UI) -->
    <label class="fw-bold mb-1">Calificación</label>

    <input type="hidden" name="rating" id="ratingInput" value="{{ request('rating') }}">

    <div class="dropdown mb-3">
        <button class="btn btn-outline-secondary w-100 text-start dropdown-toggle" type="button" data-bs-toggle="dropdown">
            <span id="ratingTexto" data-default="Seleccionar calificación">
                @if(request('rating'))
                    @for($j = 1; $j <= 5; $j++)
                        <i class="bi {{ $j <= request('rating') ? 'bi-star-fill text-warning' : 'bi-star text-muted' }}"></i>
                    @endfor
                @else
                    Seleccionar calificación
                @endif
            </span>
        </button>

        <ul class="dropdown-menu w-100">

            <li>
                <a class="dropdown-item rating-opcion" data-value="">
                    Todas
                </a>
            </li>

            @for($i = 5; $i >= 1; $i--)
                <li>
                    <a class="dropdown-item rating-opcion" data-value="{{ $i }}">
                        @for($j = 1; $j <= 5; $j++)
                            <i class="bi {{ $j <= $i ? 'bi-star-fill text-warning' : 'bi-star text-muted' }}"></i>
                        @endfor
                    </a>
                </li>
            @endfor

        </ul>
    </div>

    <!-- BOTÓN -->
    <button class="btn btn-success w-100 mb-2">
        Aplicar filtros
    </button>

    <!-- LIMPIAR -->
    <a href="{{ url()->current() }}" class="btn btn-light w-100">
        Limpiar filtros
    </a>

</form>
