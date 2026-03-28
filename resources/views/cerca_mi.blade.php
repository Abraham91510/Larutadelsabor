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

    

    </style>
@endpush

@section('contenedor_contenido')
    <div class="text-center mb-5">
    <h1 class="fw-bold">Cerca de Mí</h1>
    
</div>
@endsection