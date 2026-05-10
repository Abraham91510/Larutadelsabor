@extends('layouts.secundario')

@section('titulopagina', $producto->nombre)

@section('favicon', $generales['logo_empresa'])

@push('css')
<style>
:root {
    --bs-orange-primary: #f27420;
    --bs-orange-hover: #e06310;
    --bg-gray-soft: #f4f4f4;
}

.bg-card-gray {
    background-color: var(--bg-gray-soft);
    border-radius: 12px;
    border: 1px solid #e0e0e0;
}

.btn-orange {
    background-color: var(--bs-orange-primary);
    color: white;
    border: none;
    font-weight: 700;
}

.btn-orange:hover {
    background-color: var(--bs-orange-hover);
}

.thumb-img {
    cursor: pointer;
    border: 2px solid transparent;
    object-fit: cover;
    height: 80px;
}

.thumb-img.active-thumb {
    border-color: var(--bs-orange-primary);
}

.accordion-button::after {
    transition: transform 0.3s ease-in-out;
}

.badge-discount {
    top: 15px;
    left: 15px;
    z-index: 10;
}

body { font-family: 'Nunito', sans-serif !important; }
h1 { font-family: 'Lilita One', cursive !important; }
h2, h3, h4, h5, h6 { font-family: 'Poppins', sans-serif !important; font-weight: 700; }
</style>
@endpush

@section('contenedor_contenido')

<div class="container py-5">
<div class="row g-5">

{{-- GALERÍA --}}
<div class="col-lg-7">
<div class="row">

<div class="col-2 d-none d-md-flex flex-column gap-3">
    @forelse($producto->imagenes as $img)
    <img src="{{ asset('Imagenes/' . basename($img->imagen)) }}"
         onerror="this.src='{{ asset('Imagenes/default.png') }}'"
         class="img-fluid rounded thumb-img {{ $loop->first ? 'active-thumb' : '' }} shadow-sm"
         onclick="cambiarImagen(this)">
@empty
    <img src="{{ asset('Imagenes/default.png') }}"
         class="img-fluid rounded shadow-sm">
@endforelse
</div>

<div class="col-10">
    <div class="position-relative">
        @if($producto->descuento)
            <span class="badge bg-danger position-absolute badge-discount p-2 rounded-pill shadow">
                -{{ $producto->descuento }}%
            </span>
        @endif

        <img id="mainImage"
            @php
    $imgPrincipal = optional($producto->imagenes->first())->imagen;
@endphp

<img id="mainImage"
     src="{{ $imgPrincipal ? asset('Imagenes/' . basename($imgPrincipal)) : asset('Imagenes/default.png') }}"
     onerror="this.src='{{ asset('Imagenes/default.png') }}'"
     class="img-fluid rounded shadow-sm w-100"
     style="height: 500px; object-fit: cover;">
    </div>
</div>

</div>

{{-- ACORDEONES --}}
<div class="accordion accordion-flush mt-5 border-top">

<div class="accordion-item">
    <button class="accordion-button fw-bold py-4" data-bs-toggle="collapse" data-bs-target="#desc">
        <i class="bi bi-justify-left me-3 text-secondary"></i> Descripción del producto
    </button>
    <div id="desc" class="accordion-collapse collapse show">
        <div class="accordion-body text-muted">
            {{ $producto->detalles->descripcion ?? $producto->descripcion }}
        </div>
    </div>
</div>

<div class="accordion-item">
    <button class="accordion-button collapsed fw-bold py-4" data-bs-toggle="collapse" data-bs-target="#ing">
        <i class="bi bi-egg-fried me-3 text-secondary"></i> Ingredientes
    </button>
    <div id="ing" class="accordion-collapse collapse">
        <div class="accordion-body">
            {{ $producto->detalles->ingredientes ?? 'No disponible' }}
        </div>
    </div>
</div>

<div class="accordion-item">
    <button class="accordion-button collapsed fw-bold py-4" data-bs-toggle="collapse" data-bs-target="#nut">
        <i class="bi bi-info-circle me-3 text-secondary"></i> Información nutricional
    </button>
    <div id="nut" class="accordion-collapse collapse">
        <div class="accordion-body">
            {{ $producto->detalles->nutricional ?? 'No disponible' }}
        </div>
    </div>
</div>

<div class="accordion-item">
    <button class="accordion-button collapsed fw-bold py-4" data-bs-toggle="collapse" data-bs-target="#adv">
        <i class="bi bi-exclamation-triangle me-3 text-danger"></i> Advertencias alimentarias
    </button>
    <div id="adv" class="accordion-collapse collapse">
        <div class="accordion-body">
            <div class="p-3 bg-card-gray rounded">
                <small class="fw-bold text-dark">Aviso:</small>
                <p class="mb-0 small text-muted">
                    {{ $producto->detalles->advertencias ?? 'Este producto puede contener alérgenos.' }}
                </p>
            </div>
        </div>
    </div>
</div>

</div>
</div>

{{-- DETALLE DERECHO --}}
<div class="col-lg-5">
<div class="ps-lg-4">

<h1 class="fw-bold h2 mb-1">{{ $producto->nombre }}</h1>

<p class="fw-bold mb-3" style="color: var(--bs-orange-primary)">
    {{ $producto->subcategoria->categoria->nombre ?? 'Sin categoría' }}
@if($producto->subcategoria)
    / {{ $producto->subcategoria->nombre }}
@endif
</p>

{{-- CALIFICACIÓN --}}
<div class="d-flex align-items-center gap-2 mb-4">
    <div class="text-warning small">⭐⭐⭐⭐⭐</div>
    <span class="fw-bold">{{ $producto->rating ?? 4.5 }}</span>
    <span class="text-muted small">(0 reseñas)</span>
</div>

{{-- PRECIO --}}
<div class="bg-card-gray p-4 mb-4">
<div class="d-flex align-items-baseline gap-2 mb-1">
    <h2 class="fw-bold mb-0">${{ number_format($producto->precio,2) }}</h2>
    <span class="text-muted small">MXN</span>
</div>
</div>

<div class="bg-card-gray p-4 mb-4">
    <div class="mb-2">🚚 Entrega en 30–40 min</div>
    <div>🔒 Pago seguro SSL</div>

    {{-- CARACTERÍSTICAS --}}
    @if($producto->caracteristicas->count())
        <hr>
        @foreach($producto->caracteristicas as $c)
            <div class="small">
                ✔ <strong>{{ $c->nombre }}:</strong> {{ $c->descripcion }}
            </div>
        @endforeach
    @endif

    {{-- COLONIAS --}}
    @if($producto->colonias->count())
        <hr>
        <div class="small">
            📍 Disponible en:
        </div>
        <div class="mt-1">
            @foreach($producto->colonias as $col)
                <span class="badge bg-dark">{{ $col->nombre }}</span>
            @endforeach
        </div>
    @endif

</div>
{{-- FORMULARIO --}}
<form action="{{ route('carrito.agregar') }}" method="POST">
@csrf

<input type="hidden" name="producto_id" value="{{ $producto->id }}">

<div class="mb-4">
    <label class="small fw-bold mb-2">Cantidad:</label>
    <div class="input-group" style="width: 140px;">
        <button type="button" class="btn btn-outline-dark"
            onclick="this.parentNode.querySelector('input').stepDown()">-</button>

        <input type="number" name="cantidad"
            class="form-control text-center fw-bold"
            value="1"
            min="1"
            max="{{ $producto->stock->stock ?? 1 }}">

        <button type="button" class="btn btn-outline-dark"
            onclick="this.parentNode.querySelector('input').stepUp()">+</button>
    </div>

    <small class="text-muted">
        Stock disponible: {{ $producto->stock->stock ?? 0 }}
    </small>
</div>

<div class="d-grid gap-2">
    <button class="btn btn-orange py-3">
        <i class="bi bi-cart-plus me-2"></i> AGREGAR AL CARRITO
    </button>
</form>

<a href="{{ route('carrito') }}" class="btn btn-dark py-3 fw-bold">
    COMPRAR AHORA
</a>
<meta name="csrf-token" content="{{ csrf_token() }}">
<p class="text-center mt-3 small text-muted">
    Precio total estimado:
    <span class="fw-bold text-dark">
        ${{ number_format($producto->precio,2) }} MXN
    </span>
</p>

</div>
</div>

</div>
</div>

@endsection

@push('js')
<script>
function cambiarImagen(img) {
    document.getElementById('mainImage').src = img.src;
    document.querySelectorAll('.thumb-img').forEach(t => t.classList.remove('active-thumb'));
    img.classList.add('active-thumb');
}
</script>
@endpush