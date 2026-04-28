@props([
    'imagenes' => [],
    'rating' => '4.5',
    'titulo' => 'Nombre del comercio',
    'categoria' => 'Categoría',
    'precio' => '$0.00',
    'descripcion' => '',
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

        {{-- 🖼️ IMÁGENES (carousel como producto) --}}
        @if(count($imagenes) > 0)
            @php $carouselId = 'card5-'.\Str::slug($titulo).'-'.uniqid(); @endphp

            <div id="{{ $carouselId }}" class="carousel slide rounded-top-4 overflow-hidden" data-bs-ride="carousel">

                <div class="carousel-inner" style="height:180px;">
                    @foreach($imagenes as $i => $img)
                        <div class="carousel-item @if($i==0) active @endif">
                            <img src="{{ asset('Imagenes/'.$img) }}"
                                 class="d-block w-100"
                                 style="height:180px; object-fit:cover;">
                        </div>
                    @endforeach
                </div>

                @if(count($imagenes) > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark rounded-circle p-2"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-dark rounded-circle p-2"></span>
                </button>
                @endif

            </div>
        @endif

        <div class="card-body position-relative">

            {{-- ⭐ rating --}}
            <span class="position-absolute top-0 end-0 m-3 badge bg-warning text-dark d-flex align-items-center gap-1">
                <i class="bi bi-star-fill"></i>
                {{ $rating }}
            </span>

            {{-- 🧾 título --}}
            <h6 class="fw-bold mb-2 mt-4 text-center text-truncate">
                {{ $titulo }}
            </h6>

            {{-- 🏷 categoría --}}
            <small class="text-muted d-flex align-items-center gap-1 mb-1 justify-content-center text-truncate">
                <i class="bi bi-tag-fill"></i>
                {{ $categoria }}
            </small>

            {{-- 💲 precio --}}
            <div class="text-center fw-bold text-success mb-2">
                ${{ number_format($precio,2) }}
            </div>

            {{-- 📄 descripción --}}
            <p class="small text-muted text-center mb-2 px-2"
               style="overflow: hidden; text-overflow: ellipsis;
                      display: -webkit-box;
                      -webkit-line-clamp: 2;
                      -webkit-box-orient: vertical;">
               {{ $descripcion }}
            </p>

            {{-- 📍 info --}}
            <div class="d-flex justify-content-between mt-2 text-muted small">
                <span><i class="bi bi-geo-alt"></i> {{ $distancia }}</span>
                <span><i class="bi bi-chat-dots"></i> {{ $resenas }}</span>
            </div>

            {{-- 🔘 botón --}}
            <a href="{{ $href }}"
               class="btn btn-success w-100 mt-3 rounded-pill">
                <i class="fas fa-utensils"></i> Ver Producto
            </a>

        </div>
    </div>
</div>