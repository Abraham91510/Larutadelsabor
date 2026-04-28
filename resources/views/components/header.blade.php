<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ $titulopagina ?? 'Mi página' }}</title>

    <link rel="icon" type="image/x-icon" href="{{ asset($favicon ?? '') }}">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.6/css/dataTables.dataTables.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">

    @stack('css')
</head>

<body>

<div class="p-5 text-center text-white position-relative"
     style="
        background-image: url('{{ asset($generales['banner'] ?? 'Imagenes/La Ruta Del Sabor_LogoPortada.png') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        min-height: 250px;
     ">

    <!-- overlay oscuro -->
    <div class="position-absolute top-0 start-0 w-100 h-100"
         style="background: rgba(0,0,0,0.5);"></div>

    <!-- contenido -->
    <div class="position-relative">

        <h1 class="d-inline-block px-4 py-2 rounded-pill shadow"
            style="background: rgba(0,0,0,0.35); backdrop-filter: blur(6px);">
            {{ $titulo ?? '' }}
        </h1>

        <br>

        <h4 class="d-inline-block mt-3 px-3 py-1 rounded-pill shadow"
            style="background: rgba(0,0,0,0.25); backdrop-filter: blur(6px);">
            {{ $subtitulo ?? '' }}
        </h4>

    </div>
</div>