@props([
    'imagenes' => [],
    'rating' => '4.5',
    'titulo' => 'Nombre del producto',
    'categoria' => 'Categoría',
    'subcategoria' => null,
    'precio' => '$0.00',
    'descripcion' => 'Descripción breve del producto',
    'distancia' => '0 km',
    'resenas' => '0',
    'href' => '#',
    'bg' => 'bg-white text-dark'
])

<div class="card {{ $bg }} border-0 rounded-4 p-3 d-flex flex-column justify-content-between w-100"
     style="
        transition: all .3s ease;
        box-shadow: 0 10px 25px rgba(0,0,0,.15), 
                    0 20px 50px rgba(0,0,0,.25);
        margin: 10px auto;
        max-width: 300px;
     "
     onmouseover="this.style.transform='translateY(-8px) scale(1.01)'; 
                 this.style.boxShadow='0 20px 40px rgba(0,0,0,.25), 0 30px 70px rgba(0,0,0,.35)';"
     onmouseout="this.style.transform='translateY(0) scale(1)'; 
                this.style.boxShadow='0 10px 25px rgba(0,0,0,.15), 0 20px 50px rgba(0,0,0,.25)';">

    @if(count($imagenes) > 0)
        @php $carouselId = 'carousel-'.\Str::slug($titulo).'-'.uniqid(); @endphp

        <div id="{{ $carouselId }}" class="carousel slide rounded-top-4 mb-3 overflow-hidden" data-bs-ride="carousel">
            
            <div class="carousel-inner" style="height: 140px;">
                @foreach($imagenes as $i => $img)
                    <div class="carousel-item @if($i==0) active @endif">
                        <img src="{{ asset('Imagenes/'.$img) }}" 
                             class="d-block w-100"
                             style="height:140px; object-fit:cover;">
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

    <!-- ⭐ rating -->
    <span class="position-absolute top-0 end-0 m-3 badge bg-warning text-dark d-flex align-items-center gap-1">
        <i class="bi bi-star-fill"></i> {{ $rating }}
    </span>

    <!-- 🧾 título -->
    <h6 class="fw-bold mt-2 text-center text-truncate">
        {{ $titulo }}
    </h6>

    <!-- 🏷 categoría -->
    <small class="text-muted d-flex align-items-center gap-1 mb-1 justify-content-center text-truncate">
        <i class="bi bi-tag-fill"></i> 
        {{ $categoria }}
        @if($subcategoria) - {{ $subcategoria }} @endif
    </small>

    <!-- 💲 precio -->
<div class="text-center mb-2">
    <span class="fw-bold text-success d-inline-flex align-items-center justify-content-center gap-1"
          style="font-size: 1.7rem;">
        <i class="bi bi-currency-dollar"></i>
        {{ $precio }}
    </span>
</div>
    <!-- 📄 descripción -->
    <p class="small text-muted text-center mb-2 px-2"
       style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">
       {{ $descripcion }}
    </p>

    <!-- 📍 info -->
    <div class="d-flex justify-content-between mt-2 text-muted small px-2">
        <span><i class="bi bi-geo-alt"></i> {{ $distancia }}</span>
        <span><i class="bi bi-chat-dots"></i> {{ $resenas }} reseñas</span>
    </div>

    <!-- 🔘 botón -->
    <a href="{{ $href }}" class="btn btn-success w-100 mt-3 rounded-pill">
        <i class="fas fa-utensils"></i> Ver Menú
    </a>
</div>