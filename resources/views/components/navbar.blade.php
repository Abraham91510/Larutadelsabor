<nav class="navbar navbar-light bg-white border-bottom py-3">
    <div class="container d-flex align-items-center">

        
        <div class="d-flex align-items-center me-4" style="flex-shrink:0;">

            
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

            
<div id="ubicacion" style="cursor:pointer; line-height:1; display:inline-block; position:relative; padding: 5px;">
    <div onclick="toggleCuadro(event)">
        <small class="text-muted">Enviar a</small><br>
        <strong style="margin-top:10px; display:inline-block;">
            <i class="bi bi-geo-alt-fill text-danger"></i>
            <span id="ciudadTexto">Detectando...</span>
        </strong>
    </div>

    <div id="inputCP" 
         style="
             display:none; 
             position:absolute; 
             top:110%; left:0; 
             background:white; 
             padding:25px; 
             border:1px solid #ccc; 
             border-radius:10px; 
             box-shadow:0 10px 30px rgba(0,0,0,0.2);
             z-index:100;
             width:360px; 
             cursor: default;">
        
        <label for="codigoPostalInput" style="font-size:0.95rem; color:#333; font-weight:bold; display:block; margin-bottom:10px;">
            Ingresa tu código postal:
        </label>
        
        <div style="display:flex; gap: 8px;">
            <input type="text" id="codigoPostalInput"
                   placeholder="Ej. 97000"
                   style="flex:1; padding:12px; border-radius:6px; border:1px solid #ccc; font-size:1rem;">
            
            <button id="guardarCP" onclick="procesarCP()" style="
                padding:10px 20px;
                border:none;
                background:#0d6efd;
                color:white;
                font-weight:bold;
                border-radius:6px;
                cursor:pointer;">
                OK
            </button>
        </div>

        <small id="mensajePais" style="color:#666; font-size:0.8rem; display:block; margin-top:10px;">
            Solo códigos de tu país
        </small>
        
        <div id="mensajeError" style="color:red; font-size:0.85rem; margin-top:10px; display:none; font-weight: 500;"></div>
    </div>
</div>

        </div>

        
        <div class="flex-grow-1">
            <select id="buscador" class="form-control w-100">
                <option></option>

                @if(isset($slot_opciones_buscador))
                    {{ $slot_opciones_buscador }}
                @endif
            </select>
        </div>

    </div>
</nav>

