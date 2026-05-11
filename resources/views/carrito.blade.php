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

            @php
                $carrito = session('carrito', []);
                $subtotal = 0;
            @endphp

            @forelse($carrito as $item)

                @php
                    $subtotal += $item['precio'] * $item['cantidad'];
                @endphp

                <div class="bg-card-gray p-3 d-flex justify-content-between align-items-center mb-3">

                    <div class="d-flex align-items-center gap-3">
                        <img src="{{ asset($item['imagen']) }}" class="carrito-img">

                        <div>
                            <h6 class="fw-bold mb-1">{{ $item['nombre'] }}</h6>
                            <small class="text-muted">{{ $item['negocio'] ?? 'Sin negocio' }}</small><br>
                            <span class="fw-bold text-success">${{ $item['precio'] }} MXN</span>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3">

                        {{-- RESTAR --}}
                        <form action="{{ route('carrito.restar', $item['id']) }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-dark">-</button>
                        </form>

                        <input type="text" value="{{ $item['cantidad'] }}" class="form-control text-center" style="width:60px" readonly>

                        {{-- SUMAR --}}
                        <form action="{{ route('carrito.sumar', $item['id']) }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-dark">+</button>
                        </form>

                        {{-- ELIMINAR --}}
                        <form action="{{ route('carrito.eliminar', $item['id']) }}" method="POST">
                            @csrf
                            <button class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>

                    </div>
                </div>

            @empty
                <div class="alert alert-warning">
                    Tu carrito está vacío 🛒
                </div>
            @endforelse

           {{-- CUPONES --}}
<div class="bg-card-gray p-3 mb-3">

    <h6 class="fw-bold mb-2">
        🎟 Cupón de descuento
    </h6>

    @if(session('cupon'))
        <div class="alert alert-success">

            Cupón aplicado:
            <b>{{ session('cupon.codigo') }}</b>

            <br>

            Descuento:
            ${{ session('cupon')['descuento'] ?? 0}} MXN

        </div>
    @endif

    <form
    action="{{ route('carrito.cupon') }}"
    method="POST"
>

    @csrf

    <div class="cupon-box">

        <input
            type="text"
            name="cupon"
            class="form-control cupon-input"
            placeholder="Ingresa tu cupón"
        >

        <button class="btn btn-dark">

            Aplicar

        </button>

    </div>

</form>

    <small class="text-muted d-block mt-2">
        💡 Usa códigos como
        <b>NUEVO26</b>,
        <b>DESCUENTO50</b>
    </small>

</div>
            {{-- NOTAS --}}
<div class="bg-card-gray p-3">

    <h6 class="fw-bold">
        📝 Notas del pedido
    </h6>

    <textarea
        name="nota"
        form="formCheckout"
        class="form-control mt-2"
        rows="3"
        placeholder="Ejemplo: sin cebolla, entregar rápido..."
    ></textarea>

</div>

        </div>

        {{-- RESUMEN --}}
        <div class="col-lg-4">

            @php
                $descuento = session('cupon.descuento', 0);

$total = $subtotal - $descuento;

if($total < 0)
{
    $total = 0;
}
            @endphp

            <div class="bg-card-gray p-4">

                <h5 class="fw-bold mb-3">Resumen</h5>

                <div class="d-flex justify-content-between">
                    <span>Subtotal</span>
                    <span>${{ $subtotal }} MXN</span>
                </div>

                <div class="d-flex justify-content-between">
                    <span>Descuento</span>
                    <span class="text-success">-${{ $descuento }} MXN</span>
                </div>

                <div class="d-flex justify-content-between">
                    <span>Envío</span>
                    <span class="text-success">Gratis</span>
                </div>

                <hr>

                <div class="d-flex justify-content-between fw-bold fs-5">
                    <span>Total</span>
                    <span>${{ $total }} MXN</span>
                </div>

                <form
    id="formCheckout"
    action="{{ route('checkout') }}"
    method="POST"
>

@csrf

{{-- TEMPORIZADOR --}}

<div class="alert alert-danger text-center mt-3">

    <h6 class="fw-bold mb-2">
        Tiempo restante para pagar
    </h6>

    <h2 id="contadorCompra">
        03:00
    </h2>

</div>

<button class="btn btn-orange w-100 mt-3 rounded-pill py-2">

    Proceder al pago

</button>

</form>

                <a href="{{ route('productos') }}" class="btn btn-dark w-100 mt-2 rounded-pill py-2">
                    Seguir comprando
                </a>

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


<script>
/*
|----------------------------------------------------------------------
| LÓGICA DEL TEMPORIZADOR (MODIFICADA)
|----------------------------------------------------------------------
*/

// Checamos desde PHP si el carrito tiene productos
// Si está vacío, esta variable será 'true'
let carritoVacio = {{ empty(session('carrito')) ? 'true' : 'false' }};

if (carritoVacio) {
    // Si el carrito está vacío, no queremos que corra el tiempo
    // Limpiamos el almacenamiento para que reinicie en 3 min la próxima vez
    localStorage.removeItem('tiempoCompra');
    
    let contador = document.getElementById('contadorCompra');
    if(contador) {
        contador.innerHTML = "00:00";
    }
} else {
    // SI HAY PRODUCTOS, EJECUTAMOS TU CÓDIGO ORIGINAL
    let tiempoGuardado = localStorage.getItem('tiempoCompra');

    let tiempo = tiempoGuardado
        ? parseInt(tiempoGuardado)
        : 180;

    let contador = document.getElementById('contadorCompra');

    let temporizador = setInterval(function(){

        let minutos = Math.floor(tiempo / 60);
        let segundos = tiempo % 60;

        minutos = minutos < 10 ? '0' + minutos : minutos;
        segundos = segundos < 10 ? '0' + segundos : segundos;

        if(contador) {
            contador.innerHTML = minutos + ':' + segundos;
        }

        localStorage.setItem('tiempoCompra', tiempo);
        tiempo--;

        if(tiempo < 0) {
            clearInterval(temporizador);
            localStorage.removeItem('tiempoCompra');
            alert('El tiempo para pagar expiró');
            window.location.href = "{{ route('carrito') }}";
        }

    }, 1000);
}

/*
|----------------------------------------------------------------------
| TUS OTRAS FUNCIONES (SE MANTIENEN IGUAL)
|----------------------------------------------------------------------
*/

let formCheck = document.getElementById('formCheckout');
if(formCheck) {
    formCheck.addEventListener('submit', function(){
        localStorage.removeItem('tiempoCompra');
    });
}
</script>

@endsection