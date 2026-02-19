@extends('layouts.principal')
@section('titulopagina', 'La Ruta Del Sabor')
@section('favicon', 'Imagenes/La Ruta Del Sabor_Logo.ico')

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
            font-family: Verdana, Geneva, Tahoma, sans-serif !important;
        }

        h1{
        font-family: 'Lilita One', cursive !important;
        }
        h2, h3, h4, h5, h6 {
        font-family: 'Aptos', sans-serif !important;
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
    LA RUTA DEL SABOR
@endsection

@section('subtitulo')
    Siempre visible. Siempre a tiempo.
@endsection

@section('carrusel_pagina_principal')
<x-carrusel>
    <x-slot name="titulo1">Apoya la Economía Local</x-slot>
    <x-slot name="texto1">Compra productos locales de comida y ayuda a crecer a tu comunidad.</x-slot>
    <x-slot name="imagen1">/Imagenes/imagen05.jpg</x-slot>
    <x-slot name="icono1"><i class="bi bi-hand-thumbs-up fs-3"></i></x-slot>

    <x-slot name="titulo2">Prueba la nueva Hamburguesa "Magnificarne"</x-slot>
    <x-slot name="texto2">Producto 100% con carne natural a 99 MXN.</x-slot>
    <x-slot name="imagen2">/Imagenes/imagen06.png</x-slot>
    <x-slot name="icono2"><i class="bi bi-basket2-fill fs-3"></i></x-slot>
</x-carrusel>
@endsection

@section('contenedor_quienes_somos')
<x-cuadro>
    <x-slot name="titulo">¿Quiénes Somos?</x-slot>
    <x-slot name="subtitulo">Nuestra identidad como empresa</x-slot>
    <x-slot name="color_titulo">#B8860B</x-slot>
    <x-slot name="color_subtitulo">#FFFFFF</x-slot>
    <x-slot name="background">#A9DFBF</x-slot>

    <div class="row g-4">

        <x-card6>
        <x-slot name="bg">bg-white</x-slot>
        <x-slot name="icono"><i class="bi bi-bullseye"></i></x-slot>
        <x-slot name="color_icono">text-success</x-slot>
        <x-slot name="titulo">Misión</x-slot>
        <x-slot name="texto">
            Ofrecer una plataforma digital integral que facilite la
            localización y contratación de comerciantes ambulantes de
            comida, permitiendo a los usuarios encontrar opciones
            cercanas de manera rápida y confiable, mientras se brinda a
            los prestadores una herramienta accesible para mejorar su
            visibilidad, organización y ventas. La Ruta Del Sabor promueve
            el uso de tecnología segura, pagos digitales validados y medios
            de movilidad de bajo impacto, fortaleciendo la economía local y
            el consumo responsable dentro de la comunidad.
        </x-slot>
         <x-slot name="posicion_Imagen">izquierda</x-slot>
        <x-slot name="imagen">/Imagenes/imagen12.png</x-slot>

    </x-card6>

    <x-card6>
        <x-slot name="bg">bg-white</x-slot>
        <x-slot name="icono"><i class="bi bi-eye"></i></x-slot>
        <x-slot name="color_icono">text-primary</x-slot>
        <x-slot name="titulo">Visión</x-slot>
        <x-slot name="texto">
            Consolidarse como un referente en servicios digitales de
            comida ambulante, integrando innovación tecnológica,
            accesibilidad e inclusión para transformar el comercio móvil en
            una actividad más ordenada, segura y sostenible. La Ruta Del
            Sabor busca ser reconocida por conectar personas con la
            gastronomía local de forma eficiente, apoyar el crecimiento de
            los comerciantes ambulantes y contribuir a ciudades más
            cercanas, dinámicas y ambientalmente responsables.
        </x-slot>
        <x-slot name="posicion_Imagen">derecha</x-slot>
        <x-slot name="imagen">Imagenes/imagen13.png</x-slot>
    </x-card6>

    <x-card6>
        <x-slot name="bg">bg-white</x-slot>
        <x-slot name="icono"><i class="bi bi-flag"></i></x-slot>
        <x-slot name="color_icono">text-warning</x-slot>
        <x-slot name="titulo">Objetivo</x-slot>
        <x-slot name="texto">
            Conectar de manera eficiente y segura a clientes con
            comerciantes ambulantes de comida mediante una plataforma
            digital con geolocalización en tiempo real que prioriza la
            cercanía y la disponibilidad. Además, impulsa la economía
            local, reduce el impacto ambiental y garantiza pagos digitales
            sin efectivo mediante el uso de códigos QR para validar el
            servicio y liberar el pago automáticamente, ofreciendo también
            una experiencia accesible e inclusiva para todos los usuarios.

        </x-slot>
         <x-slot name="posicion_Imagen">izquierda</x-slot>
        <x-slot name="imagen">Imagenes\imagen11.png</x-slot>
    </x-card6>
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
        <x-card3>
            <x-slot name="bg">bg-white</x-slot>
            <x-slot name="icono"><i class="bi bi-geo-alt-fill"></i></x-slot>
            <x-slot name="color_icono">text-success</x-slot>
            <x-slot name="titulo">Geolocalización en Tiempo Real</x-slot>
            <x-slot name="texto">Encuentra comerciantes de comida cerca de ti al instante.</x-slot>
        </x-card3>

        <x-card3>
            <x-slot name="bg">bg-white</x-slot>
            <x-slot name="icono"><i class="bi bi-shield-lock-fill"></i></x-slot>
            <x-slot name="color_icono">text-primary</x-slot>
            <x-slot name="titulo">Pagos digitales 100% Seguros</x-slot>
            <x-slot name="texto">Transacciones digitales protegidas con encriptación.</x-slot>
        </x-card3>

        <x-card3>
            <x-slot name="bg">bg-white</x-slot>
            <x-slot name="icono"><i class="bi bi-clock-fill"></i></x-slot>
            <x-slot name="color_icono">text-warning</x-slot>
            <x-slot name="titulo">Entrega Rápida</x-slot>
            <x-slot name="texto">Recibe tu comida en minutos o al instante.</x-slot>
        </x-card3>

        <x-card3>
            <x-slot name="bg">bg-white</x-slot>
            <x-slot name="icono"><i class="bi bi-people-fill"></i></x-slot>
            <x-slot name="color_icono">text-orange</x-slot>
            <x-slot name="titulo">Apoya Local</x-slot>
            <x-slot name="texto">Conecta directamente con vendedores de comida locales.</x-slot>
        </x-card3>

        <x-card3>
            <x-slot name="bg">bg-white</x-slot>
            <x-slot name="icono"><i class="bi bi-star-fill"></i></x-slot>
            <x-slot name="color_icono">text-purple</x-slot>
            <x-slot name="titulo">Calificaciones Verificadas</x-slot>
            <x-slot name="texto">Lee reseñas de clientes reales.</x-slot>
        </x-card3>

        <x-card3>
            <x-slot name="bg">bg-white</x-slot>
            <x-slot name="color_icono">text-danger</x-slot>
            <x-slot name="titulo">Crecimiento Continuo</x-slot>
            <x-slot name="texto">Más comerciantes de comida disponibles cada día.</x-slot>
        </x-card3>
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

            <x-card2>
                <x-slot name="bg">bg-white</x-slot>
                <x-slot name="icono"><i class="bi bi-currency-dollar"></i></x-slot>
                <x-slot name="color_icono">text-success</x-slot>
                <x-slot name="titulo">Pagos digitales</x-slot>
                <x-slot name="texto">Recibir pagos de manera digital.</x-slot>
            </x-card2>

            <x-card2>
                <x-slot name="bg">bg-white</x-slot>
                <x-slot name="icono"><i class="bi bi-qr-code"></i></x-slot>
                <x-slot name="color_icono">text-primary</x-slot>
                <x-slot name="titulo">Retiros con QR</x-slot>
                <x-slot name="texto">Retirar dinero mediante código QR en cajeros autorizados.</x-slot>
            </x-card2>

            <x-card2>
            <x-slot name="bg">bg-white</x-slot>
                <x-slot name="icono"><i class="bi bi-credit-card"></i></x-slot>
                <x-slot name="color_icono">text-warning</x-slot>
                <x-slot name="titulo">Tarjeta virtual</x-slot>
                <x-slot name="texto">Generar una tarjeta virtual para el uso de los fondos.</x-slot>
            </x-card2>
            </div>
</x-cuadro>
@endsection


@section('contenedor_tipos_servicios')
    
    <div class="text-center mb-5">
        <h1 class="fw-bold">Tipos de servicios</h1>
        <p class="text-muted">
            Conoce las diferentes formas en que puedes contratar servicios
        </p>
    </div>

    <div class="row g-4">

        <x-card4 orientacion="vertical" bg="bg-success bg-opacity-10">
            <x-slot name="icono"><i class="bi bi-calendar-event"></i></x-slot>
            <x-slot name="color_icono">text-success</x-slot>
            <x-slot name="titulo">Servicio programado</x-slot>
            <x-slot name="texto">
                <ul class="mb-0">
                    <li>El cliente agenda el servicio con anticipación.</li>
                    <li>Pago por transferencia bancaria dentro de la plataforma.</li>
                    <li>Confirmación de fecha, horario y alcance.</li>
                </ul>
            </x-slot>
        </x-card4>

        <x-card4 orientacion="vertical" bg="bg-primary bg-opacity-10">
            <x-slot name="icono"><i class="bi bi-lightning-fill"></i></x-slot>
            <x-slot name="color_icono">text-primary</x-slot>
            <x-slot name="titulo">Servicio inmediato</x-slot>
            <x-slot name="texto">
                <ul class="mb-0">
                    <li>Contratación de un prestador cercano y disponible.</li>
                    <li>Pago previo por transferencia bancaria.</li>
                    <li>Ideal para servicios rápidos o compras locales.</li>
                </ul>
            </x-slot>
        </x-card4>

        <x-card4 orientacion="vertical" bg="bg-warning bg-opacity-10">
            <x-slot name="icono"><i class="bi bi-map-fill"></i></x-slot>
            <x-slot name="color_icono">text-warning</x-slot>
            <x-slot name="titulo">Servicios por ruta local</x-slot>
            <x-slot name="texto">
                <ul class="mb-0">
                    <li>Aplicable a comerciantes ambulantes o móviles.</li>
                    <li>Visualización de ruta en tiempo real.</li>
                    <li>Reserva de productos o atención cercana.</li>
                </ul>
            </x-slot>
        </x-card4>

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

            <x-card5>
                <x-slot name="imagen">
                    Imagenes\imagen07.jpg
                </x-slot>
                <x-slot name="rating">4.9</x-slot>
                <x-slot name="titulo">Don Pepe - Tacos al Pastor</x-slot>
                <x-slot name="categoria">Tacos</x-slot>
                <x-slot name="distancia">0.5 km</x-slot>
                <x-slot name="resenas">245</x-slot>
                <x-slot name="href">{{ route('vista_inicio') }}</x-slot>
            </x-card5>

            <x-card5>
                <x-slot name="imagen">
                Imagenes\imagen08.jpg
                </x-slot>
                <x-slot name="rating">4.8</x-slot>
                <x-slot name="titulo">Doña María - Cochinita</x-slot>
                <x-slot name="categoria">Comida Yucateca</x-slot>
                <x-slot name="distancia">1.2 km</x-slot>
                <x-slot name="resenas">198</x-slot>
                <x-slot name="href">{{ route('vista_inicio') }}</x-slot>
            </x-card5>

            <x-card5>
                <x-slot name="imagen">
                    Imagenes\imagen09.jpg
                </x-slot>
                <x-slot name="rating">4.7</x-slot>
                <x-slot name="titulo">Carnitas Artesanales</x-slot>
                <x-slot name="categoria">Carnes</x-slot>
                <x-slot name="distancia">0.8 km</x-slot>
                <x-slot name="resenas">167</x-slot>
                <x-slot name="href">{{ route('vista_inicio') }}</x-slot>
            </x-card5>

            <x-card5>
                <x-slot name="imagen">
                    Imagenes\imagen10.jpg
                </x-slot>
                <x-slot name="rating">4.9</x-slot>
                <x-slot name="titulo">Pupusas Típicas</x-slot>
                <x-slot name="categoria">Comida Centroamericana</x-slot>
                <x-slot name="distancia">1.5 km</x-slot>
                <x-slot name="resenas">212</x-slot>
                <x-slot name="href">{{ route('vista_inicio') }}</x-slot>
            </x-card5>

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
