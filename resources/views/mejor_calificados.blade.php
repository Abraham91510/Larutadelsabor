@extends('layouts.nuestros_comerciantes')
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

@section('contenedor_1')
    <div class="text-center mb-5">
    <h1 class="fw-bold">Mejor Calificados</h1>
    
</div>
@endsection