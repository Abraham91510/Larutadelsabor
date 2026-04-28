@extends('layouts.secundario')

@section('titulopagina', 'Carrito de Compras')
@section('favicon', $generales['logo_empresa'])

@push('css')
<style>
:root {
    --bs-orange-primary: #f27420;
    --bs-orange-hover: #e06310;
    --bg-gray-soft: #f4f4f4;
}

body { font-family: 'Nunito', sans-serif !important; }
h1 { font-family: 'Lilita One', cursive !important; }

.bg-card-gray {
    background: var(--bg-gray-soft);
    border-radius: 15px;
    border: 1px solid #e0e0e0;
}

.btn-orange {
    background: var(--bs-orange-primary);
    color: #fff;
    font-weight: bold;
}

.btn-orange:hover {
    background: var(--bs-orange-hover);
    color: #fff;
}

.carrito-img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 12px;
}

.qty-box { width: 110px; }

.cupon-box {
    display: flex;
    gap: 10px;
}

.cupon-input {
    border-radius: 10px;
}


        .fondo { background: #2D9F4F; }
    .img-responsive { width: 100%; height: 100%; }

    body { font-family: 'Nunito', sans-serif !important; }
    h1 { font-family: 'Lilita One', cursive !important; }
    h2, h3, h4, h5, h6 { font-family: 'Poppins', sans-serif !important; font-weight: 700; }

    
</style>
@endpush

@section('contenedor_contenido')

<div class="container py-5">

    <div class="text-center mb-4">
        <h1 class="fw-bold">Carrito</h1>
        <p class="text-muted">Revisa y finaliza tu pedido</p>
    </div>

    <div class="row g-4">

        {{-- PRODUCTOS --}}
        <div class="col-lg-8">

            {{-- ITEM --}}
            <div class="bg-card-gray p-3 d-flex justify-content-between align-items-center mb-3">

                <div class="d-flex align-items-center gap-3">
                    <img src="{{ asset('Imagenes/burger1.png') }}" class="carrito-img">

                    <div>
                        <h6 class="fw-bold mb-1">Hamburguesa BBQ</h6>
                        <small class="text-muted">The Gourmet Kitchen</small><br>
                        <span class="fw-bold text-success">$129 MXN</span>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-3">

                    <div class="input-group qty-box">
                        <button class="btn btn-outline-dark">-</button>
                        <input type="text" value="1" class="form-control text-center" readonly>
                        <button class="btn btn-outline-dark">+</button>
                    </div>

                    <button class="btn btn-danger btn-sm">
                        <i class="bi bi-trash"></i>
                    </button>

                </div>
            </div>

            {{-- CUPONES --}}
            <div class="bg-card-gray p-3 mb-3">

                <h6 class="fw-bold mb-2">🎟 Cupón de descuento</h6>

                <div class="cupon-box">
                    <input type="text" class="form-control cupon-input" placeholder="Ingresa tu cupón (ej: NUEVO26)">
                    <button class="btn btn-dark">Aplicar</button>
                </div>

                <small class="text-muted d-block mt-2">
                    💡 Usa códigos como <b>NUEVO26</b> o <b>BBQ10</b>
                </small>

            </div>

            {{-- NOTAS --}}
            <div class="bg-card-gray p-3">

                <h6 class="fw-bold">📝 Notas del pedido</h6>
                <textarea class="form-control mt-2" rows="3" placeholder="Ej: Sin cebolla, extra salsa, etc."></textarea>

            </div>

        </div>

        {{-- RESUMEN --}}
        <div class="col-lg-4">

            <div class="bg-card-gray p-4">

                <h5 class="fw-bold mb-3">Resumen</h5>

                <div class="d-flex justify-content-between">
                    <span>Subtotal</span>
                    <span>$129 MXN</span>
                </div>

                <div class="d-flex justify-content-between">
                    <span>Descuento</span>
                    <span class="text-success">-$10 MXN</span>
                </div>

                <div class="d-flex justify-content-between">
                    <span>Envío</span>
                    <span class="text-success">Gratis</span>
                </div>

                <hr>

                <div class="d-flex justify-content-between fw-bold fs-5">
                    <span>Total</span>
                    <span>$119 MXN</span>
                </div>

                <button class="btn btn-orange w-100 mt-3 rounded-pill py-2">
                    Proceder al pago
                </button>

                <button class="btn btn-dark w-100 mt-2 rounded-pill py-2">
                    Seguir comprando
                </button>

                {{-- EXTRAS --}}
                <hr>

                <small class="text-muted d-block">
                    🚚 Entrega estimada: 30–40 min  
                </small>

                <small class="text-muted d-block">
                    🔒 Pago seguro SSL
                </small>

            </div>

        </div>

    </div>

</div>

@endsection