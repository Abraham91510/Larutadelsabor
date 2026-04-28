@props(['carrusel'])

<div class="container my-5">
    <div id="heroCarrusel" class="carousel slide" data-bs-ride="carousel">

        <div class="carousel-inner rounded-4 overflow-hidden">

            @foreach($carrusel as $item)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">

                <img src="/{{ $item->imagen }}"
                     class="d-block w-100"
                     style="height:380px;object-fit:cover;">

                <div class="carousel-caption bg-dark bg-opacity-50 rounded-4 p-3">

                    <i class="{{ $item->icono }}"
                       style="
                        color: {{ $item->icono_color ?? '#fff' }};
                        font-size: {{ $item->icono_size ?? '24px' }};
                       ">
                    </i>

                    <h1 style="
                        color: {{ $item->titulo_color ?? '#fff' }};
                        font-size: {{ $item->titulo_size ?? '32px' }};
                    ">
                        {{ $item->titulo }}
                    </h1>

                    <p style="
                        color: {{ $item->texto_color ?? '#fff' }};
                        font-size: {{ $item->texto_size ?? '16px' }};
                    ">
                        {{ $item->texto }}
                    </p>

                </div>

            </div>
            @endforeach

        </div>

        <button class="carousel-control-prev" data-bs-target="#heroCarrusel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>

        <button class="carousel-control-next" data-bs-target="#heroCarrusel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>

    </div>
</div>