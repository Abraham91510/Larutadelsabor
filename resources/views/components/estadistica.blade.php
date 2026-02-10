@props([])

<div class="col-md-3 text-center">

    @isset($icono)
        <div class="mb-2 fs-1 {{ $color ?? 'text-primary' }}">
            {!! $icono !!}
        </div>
    @endisset

    <h2 class="fw-bold {{ $color ?? 'text-primary' }}">
        {{ $valor ?? '0' }}
    </h2>

    <p class="mb-0">
        {{ $texto ?? 'Descripción' }}
    </p>

</div>
