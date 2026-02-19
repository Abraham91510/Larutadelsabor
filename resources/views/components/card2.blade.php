@props([
    'icono' => '<i class="bi bi-star-fill"></i>',
    'color_icono' => 'text-primary',
    'titulo' => 'Título del beneficio',
    'texto' => 'Descripción del beneficio',
    'bg' => 'bg-white'
])

<div class="col-md-4">
    <div
        class="card {{ $bg }} border-0 rounded-5 p-4 h-100 d-flex flex-column justify-content-start"
        style="transition: all .3s ease;
               box-shadow: 0 20px 45px rgba(0,0,0,.35);"
        onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 30px 65px rgba(0,0,0,.50)'"
        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 20px 45px rgba(0,0,0,.35)'">

        <div class="{{ $color_icono }} fs-2 mb-3">
            {!! $icono !!}
        </div>

        <h5 class="fw-bold mb-2">{{ $titulo }}</h5>

        <p class="text-muted mb-0">{{ $texto }}</p>

    </div>
</div>

