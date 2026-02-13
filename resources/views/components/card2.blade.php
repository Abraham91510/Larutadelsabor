@props([
    'icono' => '<i class="bi bi-star-fill"></i>',
    'color_icono' => 'text-primary',
    'titulo' => 'Título del beneficio',
    'texto' => 'Descripción del beneficio',
    'bg' => 'bg-white'
])

<div class="col-md-4">
    <div
        class="card {{ $bg }} border border-dark rounded-4 p-4 h-100
        d-flex flex-column justify-content-between shadow text-center"
        style="transition: all .3s ease;"
        onmouseover="this.style.transform='translateY(-10px)'; this.classList.add('shadow-lg')"
        onmouseout="this.style.transform='translateY(0)'; this.classList.remove('shadow-lg')"
    >

        <div class="{{ $color_icono }} fs-1 mb-3">
            {!! $icono !!}
        </div>

        <div>
            <h5 class="fw-bold mb-2">{{ $titulo }}</h5>
            <p class="text-dark mb-0">{{ $texto }}</p>
        </div>

    </div>
</div>
