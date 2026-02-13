@props([
    'icono' => '<i class="bi bi-star-fill"></i>',
    'color_icono' => 'text-primary',
    'titulo' => 'Título del beneficio',
    'texto' => 'Descripción del beneficio',
    'orientacion' => 'vertical',
    'bg' => 'bg-white'
])

<div class="col-md-4">
    <div class="card {{ $bg }} border-0 shadow-lg rounded-5 p-4 h-100"
    style="transition: all .3s ease;"
    onmouseover="this.style.transform='translateY(-10px)'; this.classList.add('shadow-xl')"
    onmouseout="this.style.transform='translateY(0)'; this.classList.remove('shadow-xl')">
        <div class="{{ $color_icono }} fs-1 mb-3 text-center">
            {!! $icono !!}
        </div>

        <h5 class="fw-bold text-center mb-2">{{ $titulo }}</h5>

        <div class="text-start">
            {!! $texto !!}
        </div>
    </div>
</div>

