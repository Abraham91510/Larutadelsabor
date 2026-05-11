@extends('layouts.secundario')

@section('contenedor_contenido')

<div class="container-fluid py-4 py-md-5">
    <div class="row justify-content-center">
        {{-- col-12 para móviles, col-md-6 para tablets, col-lg-4 para PC --}}
        <div class="col-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-dark text-white text-center py-3">
                    <h4 class="mb-0 fw-bold">COMPROBANTE QR</h4>
                </div>

                <div class="card-body text-center p-3 p-md-4">
                    <p class="text-muted mb-1 small">Muestra este código al repartidor</p>
                    <h5 class="fw-bold mb-3">Folio: {{ $pedido->folio }}</h5>
                    
                    <hr class="my-3">

                    {{-- Contenedor del QR responsivo --}}
                    <div class="d-inline-block p-2 p-md-3 border rounded-3 bg-white shadow-sm my-2 w-100" style="max-width: 300px;">
                        <div class="qr-container">
                            {{-- size(null) y el estilo CSS hacen que el SVG sea responsivo --}}
                            {!! QrCode::size(250)->margin(1)->generate($textoQr) !!}
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="alert alert-warning py-2 mb-0 fw-bold border-0">
                            TOTAL: ${{ number_format($pedido->total, 2) }}
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <a href="{{ route('mis.pedidos') }}" class="btn btn-dark btn-lg rounded-pill shadow-sm">
                            <i class="bi bi-arrow-left-circle me-2"></i>Volver
                        </a>
                    </div>
                </div>
            </div>

            <p class="text-center text-muted mt-4 small">
                <i class="bi bi-info-circle me-1"></i> Este código contiene los datos de tu compra.
            </p>

        </div>
    </div>
</div>

<style>
    /* Asegura que el SVG del QR no se desborde y se ajuste al contenedor */
    .qr-container svg {
        width: 100% !important;
        height: auto !important;
        max-width: 250px;
    }
    
    .card {
        overflow: hidden;
    }
</style>

@endsection