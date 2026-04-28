@extends('administrador.layouts.dashboard_admin')

@section('content')

<h2>Listado Productos</h2>

<button class="btn btn-success mb-3" onclick="abrirModalNuevo()">
    <i class="fa fa-plus"></i> Agregar nuevo
</button>

<div class="table-responsive">
<table id="tablaProductos" class="table table-striped table-bordered">

<thead>
<tr>
    <th>Imagen</th>
    <th>Nombre</th>
    <th>Precio</th>
    <th>Rating</th>
    <th>Icono</th>
    <th>Colonias</th>
    <th>Descripción</th>
    <th>Categoría</th>
    <th>Subcategoría</th>
    <th>Destacado</th>
    <th>⭐</th>
    <th>Estado</th>
    <th>Acciones</th>
    <th>Eliminar</th>
</tr>
</thead>

<tbody>
@foreach($data as $item)
<tr>

{{-- IMÁGENES --}}
<td>
    @foreach($item->imagenes as $img)
        <img src="{{ asset('Imagenes/'.$img->imagen) }}"
             style="width:60px;height:50px;object-fit:cover;border-radius:6px;margin:2px;">
    @endforeach
</td>

<td>{{ $item->nombre }}</td>
<td>${{ $item->precio }}</td>
<td>{{ $item->rating }}</td>

<td style="font-size:20px;">
    <i class="{{ $item->icono }}"></i>
</td>

{{-- COLONIAS --}}
<td>
    @foreach($item->colonias as $col)
        <span class="badge bg-primary">{{ $col->nombre }}</span>
    @endforeach
</td>

<td>{{ $item->descripcion }}</td>
<td>{{ optional($item->subcategoria->categoria)->nombre }}</td>
<td>{{ $item->subcategoria->nombre ?? '' }}</td>

{{-- ESTADO --}}
<td>
    <button class="btn {{ $item->is_active ? 'btn-danger' : 'btn-success' }}"
            onclick="toggleEstado({{ $item->id }})">
        {{ $item->is_active ? 'Desactivar' : 'Activar' }}
    </button>
</td>

{{-- Estatus visual --}}
<td>
    <span class="badge {{ $item->is_destacado ? 'bg-warning text-dark' : 'bg-secondary' }}">
        {{ $item->is_destacado ? 'Sí' : 'No' }}
    </span>
</td>

{{-- Botón Switch rápido --}}
<td>
    <button class="btn btn-sm {{ $item->is_destacado ? 'btn-warning' : 'btn-outline-warning' }}"
            onclick="toggleDestacado({{ $item->id }})">
        <i class="fa {{ $item->is_destacado ? 'fa-star' : 'fa-star-o' }}"></i>
    </button>
</td>


{{-- ACCIONES --}}
<td>
    <button class="btn btn-primary btnEditar"
        data-id="{{ $item->id }}"
        data-nombre="{{ $item->nombre }}"
        data-precio="{{ $item->precio }}"
        data-rating="{{ $item->rating }}"
        data-icono="{{ $item->icono }}"
        data-colonias='@json($item->colonias->pluck("id"))'
        data-descripcion="{{ $item->descripcion }}"
        data-categoria="{{ optional($item->subcategoria->categoria)->slug }}"
        data-subcategoria="{{ $item->subcategoria_id }}"
        data-destacado="{{ $item->is_destacado }}"
        data-imagenes='@json($item->imagenes->map(fn($i) => ["id" => $i->id, "imagen" => $i->imagen]))'>
        <i class="fa fa-pencil"></i>
    </button>
</td>

{{-- ELIMINAR --}}
<td>
    <button class="btn btn-dark"
            onclick="eliminar({{ $item->id }})">
        Eliminar
    </button>
</td>

</tr>
@endforeach
</tbody>

</table>
</div>

{{-- ================= MODAL ================= --}}
<div class="modal fade" id="modalProducto" tabindex="-1">
<div class="modal-dialog modal-lg">
<form id="formProducto" enctype="multipart/form-data">

@csrf

<div class="modal-content">

<div class="modal-header">
    <h5 class="modal-title">Formulario Productos</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">

<input type="hidden" id="id">

<label>Nombre</label>
<input type="text" id="nombre" class="form-control" required>

<label class="mt-2">Precio</label>
<input type="number" id="precio" class="form-control" step="0.01" required>

{{-- RATING DECIMAL --}}
<label class="mt-2">Rating</label>
<input type="number" id="rating" class="form-control" step="0.1" min="1" max="5">

<div class="form-check form-switch mt-3 mb-2">
        <input class="form-check-input" type="checkbox" id="is_destacado">
        <label class="form-check-label fw-bold" for="is_destacado">¿Producto Destacado? (Aparecerá en Inicio)</label>
    </div>

<label class="mt-2">Icono</label>
<input type="text" id="icono" class="form-control">

<hr>

<label>Descripción</label>
<textarea id="descripcion" class="form-control" rows="3"></textarea>

<label class="mt-2">Categoría</label>
<select id="categoria" class="form-control">
    <option value="">-- Selecciona categoría --</option>
    @foreach($categorias as $cat)
        <option value="{{ $cat->slug }}">{{ $cat->nombre }}</option>
    @endforeach
</select>

<label class="mt-2">Subcategoría</label>
<select id="subcategoria" class="form-control">
    <option value="">-- Selecciona subcategoría --</option>
</select>

{{-- COLONIAS --}}
<label>Seleccionar Colonia</label>
<select id="coloniasCombo" class="form-control">
    <option value="">-- Elige una colonia --</option>
    @foreach($colonias as $col)
        <option value="{{ $col->id }}" id="opt-col-{{ $col->id }}">
            {{ $col->nombre }} ({{ $col->cp }})
        </option>
    @endforeach
</select>

<div id="listaColoniasSeleccionadas" class="mt-2 d-flex flex-wrap" style="gap: 5px;">
</div>

<hr>

{{-- IMÁGENES --}}
<label>Imágenes</label>
<input type="file" id="imagenes" class="form-control" multiple accept="image/*">

<div id="preview" class="d-flex flex-wrap mt-2"></div>

</div>

<div class="modal-footer">
    <button class="btn btn-primary" type="submit">Guardar</button>
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
</div>

</div>

</form>
</div>
</div>

@endsection

{{-- ================= CSS ================= --}}
@push('css')
<style>
.badge-colonia {
    padding: 8px 12px;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.btn-remove-col {
    cursor: pointer;
    background: rgba(255,255,255,0.3);
    border-radius: 50%;
    width: 18px;
    height: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
}
.image-preview-container {
    position: relative;
    margin: 5px;
    width: 80px;
    height: 80px;
}
.image-preview-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 8px;
}
.btn-remove-image {
    position: absolute;
    top: -5px;
    right: -5px;
    background: #dc3545;
    color: white;
    border-radius: 50%;
    width: 22px;
    height: 22px;
    font-size: 14px;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10;
    box-shadow: 0 2px 4px rgba(0,0,0,0.3);
}
</style>
@endpush

{{-- ================= SCRIPTS ================= --}}
@section('scripts')

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.3.7/js/dataTables.js"></script>


<script>
$(document).ready(function(){
    $('#tablaProductos').DataTable();
});

// --- LÓGICA COLONIAS ---
let arrayColonias = []; 
function renderizarColonias() {
    $('#listaColoniasSeleccionadas').html('');
    $('#coloniasCombo option').show();
    arrayColonias.forEach(id => {
        let texto = $(`#opt-col-${id}`).text();
        $('#listaColoniasSeleccionadas').append(`
            <span class="badge bg-primary badge-colonia">
                ${texto}
                <span class="btn-remove-col" onclick="quitarColonia(${id})">X</span>
            </span>
        `);
        $(`#opt-col-${id}`).hide();
    });
    $('#coloniasCombo').val('');
}
$('#coloniasCombo').on('change', function() {
    let val = $(this).val();
    if(val && !arrayColonias.includes(parseInt(val))) {
        arrayColonias.push(parseInt(val));
        renderizarColonias();
    }
});
function quitarColonia(id) {
    arrayColonias = arrayColonias.filter(item => item !== id);
    renderizarColonias();
}

// --- LÓGICA IMÁGENES ---
let imagenesEliminadas = []; 
let dt = new DataTransfer(); 

function cargarImagenesExistentes(imagenes) {
    $('#preview').html('');
    imagenesEliminadas = []; 
    imagenes.forEach(img => {
        $('#preview').append(`
            <div class="image-preview-container existente" id="img-existente-${img.id}">
                <img src="/Imagenes/${img.imagen}">
                <button type="button" class="btn-remove-image" onclick="removerImagenExistente(${img.id})">×</button>
            </div>
        `);
    });
}

function removerImagenExistente(id) {
    $(`#img-existente-${id}`).remove();
    imagenesEliminadas.push(id);
}

$('#imagenes').on('change', function(e) {
    for (let file of e.target.files) { 
        dt.items.add(file); 
    }
    this.files = dt.files;
    renderizarPreviewNuevas();
});

function renderizarPreviewNuevas() {
    $('.image-preview-container.nueva').remove();
    for (let i = 0; i < dt.files.length; i++) {
        const reader = new FileReader();
        reader.onload = function(e) {
            $('#preview').append(`
                <div class="image-preview-container nueva">
                    <img src="${e.target.result}">
                    <button type="button" class="btn-remove-image" onclick="removerImagenNueva(${i})">×</button>
                </div>
            `);
        }
        reader.readAsDataURL(dt.files[i]);
    }
}

function removerImagenNueva(index) {
    dt.items.remove(index);
    $('#imagenes')[0].files = dt.files;
    renderizarPreviewNuevas();
}

// --- ACCIONES MODAL ---
$(document).on('click','.btnEditar',function(){
    $('#formProducto')[0].reset();
    dt = new DataTransfer(); 
    $('#id').val($(this).data('id'));
    $('#nombre').val($(this).data('nombre'));
    $('#precio').val($(this).data('precio'));
    $('#rating').val($(this).data('rating'));
    $('#icono').val($(this).data('icono'));

    // ✅ AGREGA ESTA LÍNEA
    $('#is_destacado').prop('checked', $(this).data('destacado') == 1);

    arrayColonias = $(this).data('colonias') || [];
    renderizarColonias();

    $('#descripcion').val($(this).data('descripcion'));

let categoria = $(this).data('categoria');
let subcategoria = $(this).data('subcategoria');

$('#categoria').val(categoria);

// Cargar subcategorías y luego seleccionar la correcta
fetch('/subcategorias/' + categoria)
.then(res => res.json())
.then(data => {

    let html = '<option value="">-- Selecciona subcategoría --</option>';

    data.forEach(sub => {
        let selected = sub.id == subcategoria ? 'selected' : '';
        html += `<option value="${sub.id}" ${selected}>${sub.nombre}</option>`;
    });

    $('#subcategoria').html(html);
});

    let imagenes = $(this).data('imagenes') || [];
    cargarImagenesExistentes(imagenes);

    $('#modalProducto').modal('show');
});

function abrirModalNuevo(){
    $('#formProducto')[0].reset();
    dt = new DataTransfer();
    $('#id').val('');
    $('#preview').html('');
    arrayColonias = [];
    imagenesEliminadas = [];
    renderizarColonias();

    // ✅ AGREGA ESTA LÍNEA
    $('#is_destacado').prop('checked', false);

    $('#subcategoria').html('<option value="">-- Selecciona subcategoría --</option>');

    $('#modalProducto').modal('show');
}

// --- GUARDAR ---
$('#formProducto').on('submit', function(e){
    e.preventDefault();

    // limpiar espacios
    let nombre = $('#nombre').val().trim();
    let precio = $('#precio').val();
    let rating = parseFloat($('#rating').val());
    let icono = $('#icono').val().trim();
    let descripcion = $('#descripcion').val().trim();
    let subcategoria = $('#subcategoria').val();

    // ✅ 1. AGREGA ESTA VARIABLE
    let is_destacado = $('#is_destacado').is(':checked') ? 1 : 0;

    // VALIDACIONES
    if (!nombre.trim() ||
    !precio ||
    !icono.trim() ||
    !descripcion.trim() ||
    !subcategoria) {

    alert('Todos los campos son obligatorios');
    return;
}

    if (isNaN(rating) || rating < 1 || rating > 5) {
        alert('El rating debe estar entre 1 y 5');
        return;
    }

    if (arrayColonias.length === 0) {
        alert('Debes seleccionar al menos una colonia');
        return;
    }
let id = $('#id').val();
    // VALIDAR IMÁGENES
// Crear
if (!id && dt.files.length === 0) {
    alert('Debes subir al menos una imagen');
    return;
}

// Editar (evitar dejar sin imágenes)
if (id && dt.files.length === 0 && $('.image-preview-container.existente').length === 0) {
    alert('El producto debe tener al menos una imagen');
    return;
}

    
    let formData = new FormData();

    formData.append('_token','{{ csrf_token() }}');
    formData.append('nombre', nombre);
    formData.append('precio', precio);
    formData.append('rating', rating);
    formData.append('icono', icono);
    formData.append('descripcion', descripcion);
    formData.append('subcategoria_id', subcategoria);
    formData.append('is_destacado', is_destacado);

    arrayColonias.forEach(c => formData.append('colonias[]', c));

    for(let i=0; i < dt.files.length; i++){ 
        formData.append('imagenes[]', dt.files[i]); 
    }

    if(id) {
        formData.append('_method','PUT');
        imagenesEliminadas.forEach(imgId => {
            formData.append('imagenes_eliminadas[]', imgId);
        });
    }

    let url = id ? '/productos/' + id : '/productos/store';

    fetch(url, {
    method: 'POST',
    body: formData,
    headers: {
        'Accept': 'application/json'
    }
})
    .then(r=>r.json())
    .then(()=>location.reload());
});

function toggleEstado(id){ fetch('/productos-toggle/' + id).then(()=>location.reload()); }
function eliminar(id){
    if(confirm('¿Seguro que deseas eliminar este producto?')){
        fetch('/productos/' + id,{ 
            method:'DELETE', 
            headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'} 
        }).then(()=>location.reload());
    }
}

$('#categoria').on('change', function(){

    let slug = $(this).val();

    if(!slug){
        $('#subcategoria').html('<option value="">-- Selecciona subcategoría --</option>');
        return;
    }

    fetch('/subcategorias/' + slug)
    .then(res => res.json())
    .then(data => {

        let html = '<option value="">-- Selecciona subcategoría --</option>';

        data.forEach(sub => {
            html += `<option value="${sub.id}">${sub.nombre}</option>`;
        });

        $('#subcategoria').html(html);
    });
});
</script>

@endsection