<div class="container my-5">
    <div id="heroCarrusel"
        class="carousel slide"
        data-bs-ride="carousel"
        data-bs-interval="4000">

        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarrusel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#heroCarrusel" data-bs-slide-to="1"></button>
        </div>

        <div class="carousel-inner rounded-4 overflow-hidden">

            <div class="carousel-item active">
                <img src="{{ $imagen1 ?? '/Imagenes/imagen01.png' }}"
                    class="d-block w-100"
                    style="height:380px; object-fit:cover;"
                    alt="Imagen 1">

                <div class="carousel-caption bg-dark bg-opacity-50 rounded-4 p-3">
                    {!! $icono1 ?? '' !!}
                    <h1 class="fw-bold">{{ $titulo1 ?? 'Título 1' }}</h1>
                    <p>{{ $texto1 ?? 'Texto del primer slide' }}</p>
                </div>
            </div>

            <div class="carousel-item">
                <img src="{{ $imagen2 ?? '/Imagenes/imagen01.png' }}"
                    class="d-block w-100"
                    style="height:380px; object-fit:cover;"
                    alt="Imagen 2">

                <div class="carousel-caption bg-dark bg-opacity-50 rounded-4 p-3">
                    {!! $icono2 ?? '' !!}
                    <h1 class="fw-bold">{{ $titulo2 ?? 'Título 2' }}</h1>
                    <p>{{ $texto2 ?? 'Texto del segundo slide' }}</p>
                </div>
            </div>

        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarrusel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#heroCarrusel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>

    </div>
</div>
