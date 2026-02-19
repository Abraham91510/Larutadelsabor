<div class="py-5"
     style="background-color: {{ $background }};">

    <div class="container text-center">

        @isset($titulo)
            <h1 class="fw-bold mb-3" style="color: {{ $color_titulo }};">
                {{ $titulo }}
            </h1>
        @endisset

        @isset($subtitulo)
            <h3 class="mb-4" style="color: {{ $color_subtitulo }};">
                {{ $subtitulo }}
            </h3>
        @endisset

            {{ $slot }}
    
        @isset($textoBoton)
            <a href="{{ $link ?? '#' }}"
               class="btn btn-light btn-lg fw-semibold">
                {{ $textoBoton }}
            </a>
        @endisset

    </div>

</div>
