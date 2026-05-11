@extends('layouts.secundario')

@section('titulopagina', 'Mis pedidos')

@section('contenedor_contenido')

<div class="container py-5">

    <div class="text-center mb-5">

        <h1 class="fw-bold">Mis pedidos</h1>
        <p class="text-muted">Historial de compras realizadas</p>

    </div>

    @forelse($pedidos as $pedido)

        @php
            $colorEstado = match($pedido->estado) {
                'pendiente' => 'warning',
                'entregado' => 'success',
                'cancelado' => 'danger',
                default => 'secondary'
            };
        @endphp

        <div class="card shadow-sm border-0 rounded-4 mb-4">

            <div class="card-body p-4">

                <div class="row align-items-center">

                    <div class="col-lg-3">

                        <h5 class="fw-bold mb-1">
                            {{ $pedido->folio }}
                        </h5>

                        <small class="text-muted">
                            Pedido #{{ $pedido->id }}
                        </small>

                    </div>

                    <div class="col-lg-3">

                        <span class="badge bg-{{ $colorEstado }} p-2">

                            {{ ucfirst($pedido->estado) }}

                        </span>

                    </div>

                    <div class="col-lg-3">

                        <h6 class="fw-bold text-muted mb-0">

                            <small class="text-decoration-line-through text-danger">
                                ${{ number_format($pedido->subtotal,2) }}
                            </small>

                            <br>

                            <span class="text-success">
                                ${{ number_format($pedido->total,2) }} MXN
                            </span>

                        </h6>

                    </div>

                    <div class="col-lg-3 text-lg-end mt-3 mt-lg-0">

                        <a
                            href="{{ route('pedido.qr', $pedido->id) }}"
                            class="btn btn-dark rounded-pill"
                        >
                            <i class="bi bi-qr-code"></i>
                            Ver QR
                        </a>

                    </div>

                </div>

            </div>

        </div>

    @empty

        <div class="alert alert-warning text-center">
            No tienes pedidos todavía 🛒
        </div>

    @endforelse

</div>

@endsection