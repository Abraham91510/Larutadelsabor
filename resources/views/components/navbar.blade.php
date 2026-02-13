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

                <optgroup label="Comidas">
                    <option value="Tacos al Pastor" data-icon="bi-fire">Tacos al Pastor</option>
                    <option value="Cochinita Pibil" data-icon="bi-egg">Cochinita Pibil</option>
                    <option value="Carnitas Artesanales" data-icon="bi-fork-knife">Carnitas Artesanales</option>
                    <option value="Pupusas Tipicas" data-icon="bi-circle">Pupusas Típicas</option>
                </optgroup>

                <optgroup label="Snack’s">
                    <option value="Nachos con queso" data-icon="bi-triangle">Nachos con queso</option>
                    <option value="Papas fritas" data-icon="bi-emoji-smile">Papas fritas</option>
                </optgroup>

                <optgroup label="Postres">
                    <option value="Pastel de tres leches" data-icon="bi-cake">Pastel de tres leches</option>
                    <option value="Flan napolitano" data-icon="bi-cup-hot">Flan napolitano</option>
                </optgroup>

                <optgroup label="Panaderia">
                    <option value="Pan dulce" data-icon="bi-circle-fill">Pan dulce</option>
                    <option value="Conchas tradicionales" data-icon="bi-circle">Conchas tradicionales</option>
                </optgroup>

                <optgroup label="Productos de Temporada">
                    <option value="Rosca de Reyes" data-icon="bi-star">Rosca de Reyes</option>
                    <option value="Pan de muerto" data-icon="bi-flower1">Pan de muerto</option>
                </optgroup>

                <optgroup label="Bebidas">
                    <option value="Agua de horchata" data-icon="bi-droplet">Agua de horchata</option>
                    <option value="Cafe de olla" data-icon="bi-cup-hot-fill">Café de olla</option>
                </optgroup>
        </select>
    </div>

    </div>
</nav>

