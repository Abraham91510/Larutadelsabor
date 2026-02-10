@props([
    'icono' => '<i class="bi bi-star-fill"></i>',
    'color_icono' => 'text-primary',
    'titulo' => 'Título del beneficio',
    'texto' => 'Descripción del beneficio',
    'orientacion' => 'vertical',
    'bg' => 'bg-white' 
])

<div class="col-md-4">
    <div class="card {{ $bg }} border-0 shadow-lg rounded-5 p-4 h-100 {{ $orientacion === 'horizontal' ? 'd-flex flex-row align-items-center gap-3' : '' }}">
        
        <div class="{{ $color_icono }} fs-1 mb-3 {{ $orientacion === 'horizontal' ? 'flex-shrink-0' : 'text-center' }}">
            {!! $icono !!}
        </div>

        <div class="{{ $orientacion === 'horizontal' ? '' : 'text-center' }}">
            <h5 class="fw-bold">{{ $titulo }}</h5>
            <p class="text-dark mb-0">{{ $texto }}</p>
        </div>

    </div>
</div>
