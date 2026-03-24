@extends('layouts.categoria')

@section('titulopagina', $titulopagina)
@section('favicon', $generales['logo_empresa'])

@push('css')
<style>
    .fondo { background: #2D9F4F; }
    .img-responsive { width: 100%; height: 100%; }

    body { font-family: 'Nunito', sans-serif !important; }
    h1 { font-family: 'Lilita One', cursive !important; }
    h2, h3, h4, h5, h6 { font-family: 'Poppins', sans-serif !important; font-weight: 700; }

    .social-hover:hover,
    .link-hover:hover { 
        color: #FFC107 !important; 
        transform: scale(1.2); 
        transition: all 0.3s ease; 
    }

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

    .pagination {
        margin: 0;
        font-size: 0.875rem; /* tamaño pequeño */
    }

    .pagination li a,
    .pagination li span {
        padding: 0.25rem 0.5rem;
        min-width: 32px;
        text-align: center;
    }

    .pagination li.active a {
        background-color: #0d6efd;
        border-color: #0d6efd;
        color: white;
    }
</style>
@endpush

@section('titulo')
    {{ $generales['nombre_empresa'] }}
@endsection

@section('subtitulo')
    {{ $generales['eslogan_empresa'] }}
@endsection

@section('contenedor_1')
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
                        :categoria_selected="$categoria_selected ?? null"
                        :precio_min="$precio_min"
                        :precio_max="$precio_max"
                    />
                </div>
            </div>
        </div>

        <!-- PRODUCTOS -->
        <div class="col-md-9">
            @if($productos->count() > 0)
                <div class="row row-cols-1 row-cols-md-4 g-4">
    @foreach($productos as $producto)
        <x-card-producto
            :imagenes="$producto->imagenes->pluck('imagen')->toArray()"
            :rating="$producto->rating"
            :titulo="$producto->nombre"
            :categoria="$producto->categoria->nombre ?? 'Otros'"
            :subcategoria="$producto->subcategoria->nombre ?? null"
            :precio="$producto->precio"
            :descripcion="$producto->descripcion ?? ''"
            :distancia="$producto->distancia ?? '0 km'"
            :resenas="$producto->resenas ?? 0"
            :href="route('producto', $producto->slug)"
        />
    @endforeach
</div>

                <!-- PAGINADO SIMPLE -->
                @if($productos->lastPage() > 1)
                    <div class="mt-4 d-flex justify-content-center">
                        <nav>
                            <ul class="pagination pagination-sm mb-0">
                                <!-- Página anterior -->
                                <li class="page-item {{ $productos->onFirstPage() ? 'disabled' : '' }}">
    <a class="page-link" href="{{ $productos->appends(request()->query())->previousPageUrl() }}" aria-label="Anterior">&laquo;</a>
</li>

                                <!-- Números de página -->
                                @for ($i = 1; $i <= $productos->lastPage(); $i++)
    <li class="page-item {{ $productos->currentPage() == $i ? 'active' : '' }}">
        <a class="page-link" href="{{ $productos->appends(request()->query())->url($i) }}">
            {{ $i }}
        </a>
    </li>
@endfor

                                <!-- Página siguiente -->
                                <li class="page-item {{ $productos->currentPage() == $productos->lastPage() ? 'disabled' : '' }}">
    <a class="page-link" href="{{ $productos->appends(request()->query())->nextPageUrl() }}" aria-label="Siguiente">&raquo;</a>
</li>
                            </ul>
                        </nav>
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