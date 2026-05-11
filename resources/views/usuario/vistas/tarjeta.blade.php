@extends('layouts.secundario')

@section('contenedor_contenido')
<div class="container py-4 py-md-5">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-11 col-md-8 col-lg-5">
            
            <h2 class="fw-bold text-center mb-4">MI BILLETERA</h2>

            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if($tarjeta)
                <div class="card shadow-lg border-0 rounded-4 text-white mb-4" 
                     style="background: linear-gradient(135deg, #232526 0%, #414345 100%); min-height: 220px;">
                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                        <div class="d-flex justify-content-between align-items-start">
                            <i class="bi bi-sim h2 text-warning"></i>
                            <span class="fw-bold h5">Virtual Card</span>
                        </div>
                        
                        <div class="my-4">
                            <p class="mb-1 small text-secondary">NÚMERO DE TARJETA</p>
                            <h3 class="text-spaced mb-0">**** **** **** {{ substr($tarjeta->numero, -4) }}</h3>
                        </div>

                        <div class="row">
                            <div class="col-8">
                                <p class="mb-0 small text-secondary">TITULAR</p>
                                <span class="text-uppercase fw-bold">{{ $tarjeta->titular }}</span>
                            </div>
                            <div class="col-4 text-end">
                                <p class="mb-0 small text-secondary">EXPIRA</p>
                                <span class="fw-bold">{{ $tarjeta->expiracion }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm border-0 rounded-4 text-center p-4">
                    <span class="text-muted small text-uppercase fw-bold">Saldo Disponible</span>
                    <h1 class="display-5 fw-bold text-success my-2">
                        ${{ number_format($tarjeta->saldo, 2) }}
                    </h1>
                    
                    <hr class="my-4">
                    
                    <p class="small text-muted mb-3">Recarga saldo para tus compras</p>
                    <form action="{{ route('tarjeta.recargar') }}" method="POST">
                        @csrf
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-white border-end-0">$</span>
                            <input type="number" name="monto" class="form-control border-start-0 ps-0" placeholder="0.00" required min="1">
                            <button class="btn btn-dark px-4" type="submit">Recargar</button>
                        </div>
                    </form>
                </div>

            @else
                <div class="card shadow border-0 rounded-4 p-5 text-center bg-light">
                    <div class="mb-3 text-muted">
                        <i class="bi bi-credit-card-2-back" style="font-size: 4rem;"></i>
                    </div>
                    <h4>No tienes tarjeta vinculada</h4>
                    <p class="text-muted small px-3">Registra una tarjeta para gestionar tu saldo en La Ruta del Sabor.</p>
                    <a href="{{ route('tarjeta.create') }}" class="btn btn-primary btn-lg rounded-pill px-5 mt-3 shadow">
                        Vincular Tarjeta
                    </a>
                </div>
            @endif

            <div class="text-center mt-4">
                <a href="{{ route('mis.pedidos') }}" class="text-decoration-none text-muted small">
                    <i class="bi bi-arrow-left"></i> Volver a mis pedidos
                </a>
            </div>

        </div>
    </div>
</div>

<style>
    .text-spaced { letter-spacing: 4px; font-family: 'Courier New', Courier, monospace; }
    .card { transition: all 0.3s ease; }
    @media (max-width: 576px) {
        .text-spaced { letter-spacing: 2px; font-size: 1.2rem; }
    }
</style>
@endsection