@extends('layouts.secundario')

@section('titulopagina', $titulopagina)
@section('favicon', $generales['logo_empresa'])

@push('css')
<style>
    .fondo { background: #2D9F4F; }
    .img-responsive { width: 100%; height: 100%; }

    body { font-family: 'Nunito', sans-serif !important; }
    h1 { font-family: 'Lilita One', cursive !important; }
    h2, h3, h4, h5, h6 { font-family: 'Poppins', sans-serif !important; font-weight: 700; }


    .no-productos {
        text-align: center;
        font-size: 1.2rem;
        font-weight: 600;
        padding: 50px 0;
        color: #555;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
    }

    .no-productos i {
        font-size: 1.5rem;
        color: #FFC107;
    }

    

    
</style>
@endpush

@section('titulo')
    {{ $generales['nombre_empresa'] }}
@endsection

@section('subtitulo')
    {{ $generales['eslogan_empresa'] }}
@endsection

@section('contenedor_contenido')
<div class="container">
    <div class="row">

        <!-- SIDEBAR FILTROS -->
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-sliders me-2"></i>Filtros
                    </h5>

                    <!-- Componente Filtro -->
                  <x-filtro 
    :subcategorias="$subcategorias"
    :precio_min="$precio_min"
    :precio_max="$precio_max"
    :categoria_actual="$categoria_actual" 
/>
                </div>
            </div>
        </div>

        <!-- PRODUCTOS -->
        <div class="col-md-9">
            @if($productos->count() > 0)
                <div class="row row-cols-1 row-cols-md-3 g-3">
    @foreach($productos as $producto)
        <x-card-producto
            :imagenes="$producto->imagenes->pluck('imagen')->toArray()"
            :rating="$producto->rating"
            :titulo="$producto->nombre"
            :categoria="optional($producto->subcategoria->categoria)->nombre ?? 'Otros'"
            :subcategoria="$producto->subcategoria->nombre ?? null"
            :precio="$producto->precio"
            :descripcion="$producto->descripcion ?? ''"
            :distancia="$producto->distancia ?? '0 km'"
            :resenas="$producto->resenas ?? 0"
            :href="route('producto', $producto->slug)"
        />
    @endforeach
</div>

                @if($productos->hasPages())
    <div class="mt-5 d-flex justify-content-center">
        {{ $productos->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
@endif
            @else
                <div class="no-productos text-center py-5">
                    <i class="bi bi-exclamation-triangle-fill fs-3"></i>
                    <p class="mt-3">No se encontraron resultados para esta categoría.</p>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection

@push('js')
<script>
document.querySelector("form").addEventListener("submit", function () {
    sessionStorage.removeItem("autoFiltroCategoria");
});
</script>
@endpush