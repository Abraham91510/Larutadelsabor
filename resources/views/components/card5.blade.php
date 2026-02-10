@props([
    'imagen' => '',
    'rating' => '4.5',
    'titulo' => 'Nombre del comercio',
    'categoria' => 'Categoría',
    'distancia' => '0 km',
    'resenas' => '0',
    'href' => '#'   // ← la vista decide el link
])

<div class="col-md-3">
    <div class="card h-100 shadow border-0 rounded-4 position-relative">

        <img src="{{ $imagen }}"
             class="card-img-top rounded-top-4"
             height="180"
             style="object-fit: cover">

        <span class="position-absolute top-0 end-0 m-2 badge bg-warning text-dark d-flex align-items-center gap-1">
            <i class="bi bi-star-fill"></i>
            {{ $rating }}
        </span>

        <div class="card-body">

            <h6 class="fw-bold mb-1">{{ $titulo }}</h6>

            <small class="text-muted d-flex align-items-center gap-1">
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
                Ver Menú
            </a>

        </div>
    </div>
</div>
