@extends('layouts.secundario')

@section('titulopagina', 'Hamburguesa BBQ Artesanal')


@section('favicon', $generales['logo_empresa'])

@push('css')
<style>
    :root {
        --bs-orange-primary: #f27420;
        --bs-orange-hover: #e06310;
        --bg-gray-soft: #f4f4f4; /* Gris para fondos de cuadros */
    }

    /* Cuadros con fondo gris para resaltar */
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
        transition: 0.3s;
    }

    .btn-orange:hover {
        background-color: var(--bs-orange-hover);
        color: white;
    }

    /* Miniaturas de Galería */
    .thumb-img {
        cursor: pointer;
        transition: 0.2s;
        border: 2px solid transparent;
        object-fit: cover;
        height: 80px;
    }

    .thumb-img.active-thumb {
        border-color: var(--bs-orange-primary);
    }

    /* Iconos de flecha en acordeón (rotación) */
    .accordion-button::after {
        transition: transform 0.3s ease-in-out;
    }

    /* Ajuste de badges */
    .badge-discount {
        top: 15px;
        left: 15px;
        z-index: 10;
        font-size: 0.85rem;
    }
    .badge-discount{
    pointer-events: none;
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
    <div class="row g-5">
        
        {{-- COLUMNA IZQUIERDA: GALERÍA --}}
        <div class="col-lg-7">
            <div class="row">
                {{-- Miniaturas con Cambio de Imagen --}}
                <div class="col-2 d-none d-md-flex flex-column gap-3">
                    <img src="{{ asset('Imagenes/burger1.png') }}" class="img-fluid rounded thumb-img active-thumb shadow-sm" onclick="cambiarImagen(this)">
<img src="{{ asset('Imagenes/burger2.png') }}" class="img-fluid rounded thumb-img shadow-sm" onclick="cambiarImagen(this)">
<img src="{{ asset('Imagenes/burger3.png') }}" class="img-fluid rounded thumb-img shadow-sm" onclick="cambiarImagen(this)">
                </div>

                {{-- Imagen Principal --}}
                <div class="col-10">
                    <div class="position-relative">
                        <span class="badge bg-danger position-absolute badge-discount p-2 rounded-pill shadow">-19%</span>
                        <img id="mainImage" src="{{ asset('Imagenes/burger1.png') }}" 
                             class="img-fluid rounded shadow-sm w-100" style="height: 500px; object-fit: cover;">
                    </div>
                </div>
            </div>

            {{-- SECCIÓN DE ACORDEONES CON ICONOS DE ESTADO --}}
            <div class="accordion accordion-flush mt-5 border-top" id="infoProducto">
                
                {{-- Descripción --}}
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold py-4" data-bs-toggle="collapse" data-bs-target="#desc">
                            <i class="bi bi-justify-left me-3 text-secondary"></i> Descripción del producto
                        </button>
                    </h2>
                    <div id="desc" class="accordion-collapse collapse show">
                        <div class="accordion-body text-muted">
                            Hamburguesa artesanal con carne Angus 100%, pan brioche de la casa y nuestra receta secreta de salsa BBQ.
                        </div>
                    </div>
                </div>

                {{-- Ingredientes --}}
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold py-4" data-bs-toggle="collapse" data-bs-target="#ing">
                            <i class="bi bi-egg-fried me-3 text-secondary"></i> Ingredientes
                        </button>
                    </h2>
                    <div id="ing" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            Carne Angus (180g), Pan brioche, Queso cheddar, Salsa BBQ, Papas fritas (150g), Lechuga, Tomate y Cebolla caramelizada.
                        </div>
                    </div>
                </div>

                {{-- Nutricional --}}
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold py-4" data-bs-toggle="collapse" data-bs-target="#nut">
                            <i class="bi bi-info-circle me-3 text-secondary"></i> Información nutricional
                        </button>
                    </h2>
                    <div id="nut" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            Contenido calórico: 850 kcal. Rico en proteínas (45g) y carbohidratos complejos.
                        </div>
                    </div>
                </div>

                {{-- Advertencias --}}
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold py-4" data-bs-toggle="collapse" data-bs-target="#adv">
                            <i class="bi bi-exclamation-triangle me-3 text-danger"></i> Advertencias alimentarias
                        </button>
                    </h2>
                    <div id="adv" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <div class="p-3 bg-card-gray rounded">
                                <small class="fw-bold text-dark">Aviso:</small>
                                <p class="mb-0 small text-muted">Este producto contiene gluten, lácteos y puede contener trazas de soya.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- COLUMNA DERECHA: DETALLES Y COMPRA --}}
        <div class="col-lg-5">
            <div class="ps-lg-4">
                <h1 class="fw-bold h2 mb-1">Hamburguesa BBQ Artesanal</h1>
                <p class="text-orange fw-bold mb-3" style="color: var(--bs-orange-primary)">The Gourmet Kitchen</p>
                
                <div class="d-flex align-items-center gap-2 mb-4">
                    <div class="text-warning small">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i>
                    </div>
                    <span class="fw-bold">4.7</span>
                    <span class="text-muted small">(342 reseñas)</span>
                </div>

                {{-- Cuadro de Precio y Cupones (Fondo Gris) --}}
                <div class="bg-card-gray p-4 mb-4">
                    <div class="d-flex align-items-baseline gap-2 mb-1">
                        <h2 class="fw-bold mb-0">$129</h2>
                        <span class="text-muted small">MXN</span>
                    </div>
                    <div class="mb-3 small">
                        <del class="text-muted">$159</del> <span class="text-danger ms-2 fw-bold">Ahorra $30</span>
                    </div>

                    <div class="bg-white border rounded p-3 mb-2 shadow-sm">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted d-block" style="font-size: 0.7rem;">CUPÓN BIENVENIDA</small>
                                <strong class="text-dark">NUEVO26</strong>
                            </div>
                            <button class="btn btn-sm btn-outline-dark fw-bold">Aplicar</button>
                        </div>
                    </div>
                </div>

                {{-- Cuadro de Seguridad y Envío (Fondo Gris) --}}
                <div class="bg-card-gray p-4 mb-4">
                    <div class="d-flex align-items-center gap-3 mb-3 small">
                        <i class="bi bi-shield-check text-success fs-5"></i>
                        <span class="fw-bold">Compra 100% segura</span>
                    </div>
                    <div class="d-flex align-items-center gap-3 mb-3 small">
                        <i class="bi bi-truck fs-5"></i>
                        <span>Entrega en su domicilio en <strong>30-40 min</strong></span>
                    </div>
                    <div class="d-flex align-items-center gap-3 small">
                        <i class="bi bi-fire text-danger fs-5"></i>
                        <span>Nivel de picante: 🔥 <span class="text-muted">🔥🔥</span></span>
                    </div>
                </div>

                {{-- Cantidad y Botones --}}
                <div class="mb-4">
                    <label class="small fw-bold mb-2">Cantidad:</label>
                    <div class="input-group mb-3" style="width: 140px;">
                        <button class="btn btn-outline-dark border-end-0" onclick="this.parentNode.querySelector('input').stepDown()">-</button>
                        <input type="number" class="form-control text-center fw-bold bg-white" value="1" min="1" readonly>
                        <button class="btn btn-outline-dark border-start-0" onclick="this.parentNode.querySelector('input').stepUp()">+</button>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button class="btn btn-orange py-3 shadow-sm rounded-3 mb-1">
                        <i class="bi bi-cart-plus me-2"></i> AGREGAR AL CARRITO
                    </button>
                    <button class="btn btn-dark py-3 fw-bold rounded-3">
                        COMPRAR AHORA
                    </button>
                </div>
                
                <p class="text-center mt-3 small text-muted">
                    Precio total estimado: <span class="fw-bold text-dark">$129 MXN</span>
                </p>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    const mainImage = document.getElementById('mainImage');
    const thumbs = document.querySelectorAll('.thumb-img');

    function cambiarImagen(img) {
        if (!mainImage) return;

        // Cambiar imagen principal
        mainImage.src = img.src;

        // Cambiar clase activa
        thumbs.forEach(t => t.classList.remove('active-thumb'));
        img.classList.add('active-thumb');
    }
</script>
@endpush