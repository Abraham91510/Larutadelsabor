@props([
    'icono' => '<i class="bi bi-star-fill"></i>',
    'color_icono' => 'text-primary',
    'titulo' => 'Título',
    'texto' => 'Descripción',
    'bg' => 'bg-white',
    'posicion_Imagen' => 'izquierda', 
    'imagen' => ''
])

<div class="col-12 mb-5">
    <div class="row align-items-center {{ $bg }} rounded-4 shadow p-4"
         style="transition: all .3s ease;"
         onmouseover="this.style.transform='translateY(-10px)'; this.classList.add('shadow-lg')"
         onmouseout="this.style.transform='translateY(0)'; this.classList.remove('shadow-lg')">

     
        @if($posicion_Imagen == 'izquierda')
            <div class="col-md-5 text-center mb-3 mb-md-0">
                <img src="{{ asset($imagen) }}" class="img-fluid rounded-4">
            </div>
        @endif


        <div class="col-md-7">
            <div class="d-flex align-items-center mb-3">
                <div class="fs-2 me-3 {{ $color_icono }}">
                    {!! $icono !!}
                </div>
                <h3 class="fw-bold mb-0">{{ $titulo }}</h3>
            </div>

            <p class="text-dark text-justify">
                {{ $texto }}
            </p>
        </div>

        @if($posicion_Imagen == 'derecha')
            <div class="col-md-5 text-center mt-3 mt-md-0">
                <img src="{{ asset($imagen) }}" class="img-fluid rounded-4">
            </div>
        @endif

    </div>
</div>
