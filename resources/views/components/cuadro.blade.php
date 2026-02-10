@props([
    'background' => '#000000',     
    'color_titulo' => '#ffffff',     
    'color_subtitulo' => '#ffffff', 
    'titulo' => null,                
    'subtitulo' => null,         
])

<div class="py-5 text-center"
    style="background-color: {{ $background }};">

    @isset($titulo)
        <h1 class="fw-bold mb-3" style="color: {{ $color_titulo }};">
            {{ $titulo }}
        </h1>
    @endisset

    @isset($subtitulo)
        <h4 class="mb-4" style="color: {{ $color_subtitulo }};">
            {{ $subtitulo }}
        </h4>
    @endisset

    <div class="fs-5 mb-4 text-white">
        {{ $slot }}
    </div>

    @isset($textoBoton)
        <a href="{{ $link ?? '#' }}"
        class="btn btn-light btn-lg fw-semibold">
            {{ $textoBoton }}
        </a>
    @endisset
</div>

