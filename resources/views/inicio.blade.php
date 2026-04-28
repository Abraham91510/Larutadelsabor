@extends('layouts.principal')
@section('titulopagina', $titulopagina)
@section('favicon', $generales['logo_empresa'])

@push('css')
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
@endpush

@section('titulo')
    {{ $generales['nombre_empresa'] }}
@endsection

@section('subtitulo')
    {{ $generales['eslogan_empresa'] }}
@endsection

@section('carrusel_pagina_principal')

<x-carrusel :carrusel="$carrusel" />

@endsection

@section('contenedor_quienes_somos')
<x-cuadro>
    <x-slot name="titulo">¿Quiénes Somos?</x-slot>
    <x-slot name="subtitulo">Nuestra identidad como empresa</x-slot>
    <x-slot name="color_titulo">#B8860B</x-slot>
    <x-slot name="color_subtitulo">#FFFFFF</x-slot>
    <x-slot name="background">#A9DFBF</x-slot>

    <div class="row g-4">

        @foreach($empresa as $item)
        <x-card6>

            <x-slot name="bg">bg-white</x-slot>

            <x-slot name="icono">
                <i class="{{ $item->icono }}"></i>
            </x-slot>

            <x-slot name="color_icono">
                {{ $loop->index == 0 ? 'text-success' : ($loop->index == 1 ? 'text-primary' : 'text-warning') }}
            </x-slot>

            <x-slot name="titulo">
                {{ $item->titulo }}
            </x-slot>

            <x-slot name="texto">
            {{ $item->descripcion }}
            </x-slot>

            <x-slot name="posicion_Imagen">
                {{ $loop->index % 2 == 0 ? 'izquierda' : 'derecha' }}
            </x-slot>

            <x-slot name="imagen">
                {{ $item->imagen }}
            </x-slot>

        </x-card6>
        @endforeach

    </div>
</x-cuadro>
@endsection



@section('contenedor_porque_elegirnos')
<div class="text-center mb-5">
    <h1 class="fw-bold">¿Por qué elegirnos?</h1>
    <h3 class="text-muted">
        Conecta con comerciantes de comida ambulante
    </h3>
</div>

<div class="row g-4">
    @foreach($beneficios as $item)
        <x-card3>
            <x-slot name="bg">bg-white</x-slot>
            <x-slot name="icono"><i class="{{ $item->icono }}"></i></x-slot>
            <x-slot name="color_icono">{{ $item->color_icono }}</x-slot>
            <x-slot name="titulo">{{ $item->titulo }}</x-slot>
            <x-slot name="texto">{{ $item->texto }}</x-slot>
        </x-card3>
    @endforeach
</div>
@endsection

@section('contenedor_beneficios')
<x-cuadro>
    <x-slot name="titulo">Beneficios</x-slot>
    <x-slot name="subtitulo">
        La Ruta del Sabor incluye la opción de asociar una cuenta bancaria virtual
        en un banco participante para quienes no cuenten con una
    </x-slot>
    <x-slot name="color_titulo">#0A0A0A</x-slot>
    <x-slot name="color_subtitulo">#FFFFFF</x-slot>
    <x-slot name="background">#F5C29B</x-slot>

   <div class="row g-4">
        @foreach($beneficios_bancarios as $item)
            <x-card2>
                <x-slot name="bg">bg-white</x-slot>
                <x-slot name="icono"><i class="{{ $item->icono }}"></i></x-slot>
                <x-slot name="color_icono">{{ $item->color_icono }}</x-slot>
                <x-slot name="titulo">{{ $item->titulo }}</x-slot>
                <x-slot name="texto">{{ $item->texto }}</x-slot>
            </x-card2>
        @endforeach
    </div>

</x-cuadro>
@endsection


@section('contenedor_tipos_servicios')
    <div class="text-center mb-5">
        <h1 class="fw-bold">Tipos de servicios</h1>
        <p class="text-muted">Conoce las diferentes formas en que puedes contratar servicios</p>
    </div>

    <div class="row g-4">
        @foreach($tipos_servicios as $item)
            <x-card4 orientacion="vertical" bg="{{ $item->bg_clase }}">
                <x-slot name="icono"><i class="{{ $item->icono }}"></i></x-slot>
                <x-slot name="color_icono">{{ $item->color_icono }}</x-slot>
                <x-slot name="titulo">{{ $item->titulo }}</x-slot>
                <x-slot name="texto">
                    {!! $item->texto !!}
                </x-slot>
            </x-card4>
        @endforeach
    </div>
@endsection

@section('contenedor_comerciantes_destacados')
<x-cuadro>
    <x-slot name="titulo">Comerciantes Destacados</x-slot>

    <x-slot name="subtitulo">
        Descubre los comercios más populares cerca de ti
    </x-slot>

    <x-slot name="color_titulo">#B8860B</x-slot>
    <x-slot name="color_subtitulo">#FFFFFF</x-slot>
    <x-slot name="background">#A9DFBF</x-slot>

        <div class="row g-4">
@foreach($destacados as $producto)

<x-card5
    :imagenes="$producto->imagenes->pluck('imagen')->toArray()"
    :rating="$producto->rating"
    :titulo="$producto->nombre"
    :categoria="optional($producto->subcategoria->categoria)->nombre ?? 'Otros'"
    :precio="$producto->precio"
    :descripcion="$producto->descripcion"
    :distancia="$producto->distancia ?? '0 km'"
    :resenas="$producto->resenas ?? 0"
    :href="route('producto', $producto->slug)"
/>

@endforeach
</div>
</x-cuadro>
@endsection

@section('contenedor_estadistica_crecimiento_empresa')
<div class="row g-4">

    <x-estadistica>
        <x-slot name="icono"><i class="bi bi-shop"></i></x-slot>
        <x-slot name="valor">1,200+</x-slot>
        <x-slot name="color">text-success</x-slot>
        <x-slot name="texto">Comerciantes Activos</x-slot>
    </x-estadistica>

    <x-estadistica>
        <x-slot name="icono"><i class="bi bi-people"></i></x-slot>
        <x-slot name="valor">50K+</x-slot>
        <x-slot name="color">text-warning</x-slot>
        <x-slot name="texto">Clientes Satisfechos</x-slot>
    </x-estadistica>

    <x-estadistica>
        <x-slot name="icono"><i class="bi bi-bag-check"></i></x-slot>
        <x-slot name="valor">100K+</x-slot>
        <x-slot name="color">text-primary</x-slot>
        <x-slot name="texto">Órdenes Completadas</x-slot>
    </x-estadistica>

    <x-estadistica>
        <x-slot name="icono"><i class="bi bi-star-fill"></i></x-slot>
        <x-slot name="valor">4.8</x-slot>
        <x-slot name="color">text-warning</x-slot>
        <x-slot name="texto">Calificación Promedio</x-slot>
    </x-estadistica>

</div>
@endsection
