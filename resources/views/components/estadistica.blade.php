@props([])

<div class="col-md-3 text-center" style="transition: all .3s ease;"
         onmouseover="this.style.transform='translateY(-10px)'; this.classList.add('shadow-xl')"
         onmouseout="this.style.transform='translateY(0)'; this.classList.remove('shadow-xl')">

    @isset($icono)
        <div class="mb-2 fs-1 {{ $color ?? 'text-primary' }}">
            {!! $icono !!}
        </div>
    @endisset

    <h2 class="fw-bold {{ $color ?? 'text-primary' }}">
        {{ $valor ?? '0' }}
    </h2>

    <p class="mb-0">
        {{ $texto ?? 'Descripción' }}
    </p>

</div>
