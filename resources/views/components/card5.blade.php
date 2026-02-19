@props([
    'imagen' => '',
    'rating' => '4.5',
    'titulo' => 'Nombre del comercio',
    'categoria' => 'Categoría',
    'distancia' => '0 km',
    'resenas' => '0',
    'href' => '#'
])

<div class="col-md-3">
    <div class="card h-100 border-0 rounded-4 position-relative"
        style="transition: all .3s ease;
               box-shadow: 0 20px 45px rgba(0,0,0,.35);"
        onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 30px 65px rgba(0,0,0,.50)'"
        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 20px 45px rgba(0,0,0,.35)'">

        <img src="{{ $imagen }}"
             class="card-img-top rounded-top-4"
             height="180"
             style="object-fit: cover">

        <div class="card-body position-relative">

            <span class="position-absolute top-0 end-0 m-3 badge bg-warning text-dark d-flex align-items-center gap-1">
                <i class="bi bi-star-fill"></i>
                {{ $rating }}
            </span>

            <h6 class="fw-bold mb-2 mt-4 text-center">{{ $titulo }}</h6>

            <small class="text-muted d-flex align-items-center gap-1 mb-2">
                <i class="bi bi-tags"></i>
                {{ $categoria }}
            </small>

            <div class="d-flex justify-content-between mt-2 text-muted small">
                <span>
                    <i class="bi bi-geo-alt"></i>
                    {{ $distancia }}
                </span>
                <span>
                    <i class="bi bi-chat-dots"></i>
                    {{ $resenas }} reseñas
                </span>
            </div>

            <a href="{{ $href }}"
               class="btn btn-success w-100 mt-3 rounded-pill">
                <i class="fas fa-utensils"></i> Ver Menú
            </a>

        </div>
    </div>
</div>
