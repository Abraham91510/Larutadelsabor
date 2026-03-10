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
    .link-hover:hover { color: #FFC107 !important; transform: scale(1.2); transition: all 0.3s ease; }

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

@section('contenedor_1')
<div class="container">

    @if($productos->count() > 0)
        <div class="row row-cols-1 row-cols-md-5 g-4 mt-4">
            @foreach($productos as $producto)
                <x-card-producto
                    :imagen="$producto->imagen"
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

        <div class="mt-5">
            {{ $productos->links() }}
        </div>
    @else
        <div class="no-productos">
            <!-- Icono alerta al lado del texto -->
            <i class="bi bi-exclamation-triangle-fill"></i>
            No se encontraron resultados para esta categoría.
        </div>
    @endif

</div>
@endsection