<nav class="navbar navbar-light bg-white border-bottom py-3">
    <div class="container d-flex align-items-center justify-content-between">

       <div class="d-flex gap-2">
 
    <div class="rounded-circle bg-warning d-flex align-items-center justify-content-center" 
         style="width:100px; height:100px; overflow:hidden;">
       @if(isset($slot_logo))
    @if(isset($slot_ruta_inicio))
        <a href="{{ $slot_ruta_inicio}}">
            <img src="{{ $slot_logo }}" alt="Logo" class="w-100 h-100" style="object-fit:cover;">
        </a>
    @else
        <img src="{{ $slot_logo }}" alt="Logo" class="w-100 h-100" style="object-fit:cover;">
    @endif
@else
    <i class="bi bi-shop fs-3 text-white"></i>
@endif

    </div>

    <div class="d-flex flex-column">
    
        <strong style="font-family:'Lilita One',cursive;font-size:1.5rem; line-height:1.2;">
            {{ $slot_titulo ?? 'La Ruta del Sabor' }}
        </strong>

        
        <small class="text-warning" style="font-family:'Lilita One',cursive;font-size:1rem; font-weight:400;">
            {{ $slot_eslogan ?? 'Siempre visible. Siempre a tiempo.' }}
        </small>

    
        <div style="height:1.5rem;"></div>

    
        <div>
            {!! $slot_acciones ?? '<span><i class="bi bi-geo-alt"></i> Mi ubicación</span>' !!}
        </div>
    </div>
</div>

<div class="flex-grow-1 mx-3">    
    <select id="buscador" class="form-control w-100" style="width:100%">
        <option></option>

        @if(isset($slot_opciones_buscador))
            {{ $slot_opciones_buscador }}
        @endif

    </select>
</div>

    </div>
</nav>

