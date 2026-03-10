@props(['subcategorias'])

<div class="position-relative">

    <!-- Botón Filtros -->
    <button id="btnFiltros" class="btn btn-outline-dark rounded-pill" type="button">
        <i class="bi bi-sliders me-1"></i> Filtros
    </button>

    <!-- Panel flotante -->
    <div id="panelFiltros" class="bg-white border rounded shadow-sm p-3"
         style="display:none; position:absolute; top:110%; right:0; width:320px; z-index:1050;">
        <form method="GET">

            <!-- Subcategoría -->
            <label class="fw-bold">Subcategoría</label>
            <select name="subcategoria" class="form-control select2 mb-3">
                <option value="">Todas</option>
                @foreach($subcategorias ?? [] as $sub)
                    <option value="{{ $sub->id }}" @if(request('subcategoria') == $sub->id) selected @endif>
                        {{ $sub->nombre }}
                    </option>
                @endforeach
            </select>

            <!-- Precio mínimo -->
            <label class="fw-bold">Precio mínimo</label>
            <input type="number" name="precio_min" value="{{ request('precio_min') }}" class="form-control mb-3">

            <!-- Precio máximo -->
            <label class="fw-bold">Precio máximo</label>
            <input type="number" name="precio_max" value="{{ request('precio_max') }}" class="form-control mb-3">

            <!-- Rating con estrellas -->
            <label class="fw-bold">Rating</label>
            <select name="rating" class="form-control mb-3">
                <option value="">Todos</option>
                @for($i=1; $i<=5; $i++)
                    <option value="{{ $i }}" @if(request('rating') == $i) selected @endif>
                        {{ str_repeat('★', $i) }}{{ str_repeat('☆', 5-$i) }}
                    </option>
                @endfor
            </select>

            <button type="submit" class="btn btn-primary w-100 mt-2">
                Aplicar filtros
            </button>
        </form>
    </div>

</div>