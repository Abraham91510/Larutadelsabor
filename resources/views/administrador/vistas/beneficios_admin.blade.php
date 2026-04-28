@extends('administrador.layouts.dashboard_admin')

@section('content')
<h2>Administración de Beneficios</h2>

<button class="btn btn-success mb-3" onclick="abrirModalNuevo()">
    <i class="fa fa-plus"></i> Agregar Beneficio
</button>

<div class="table-responsive">
    <table id="tablaBeneficios" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Icono Preview</th>
                <th>Clase Icono</th>
                <th>Título</th>
                <th>Texto</th>
                <th>Orden</th>
                <th>Acciones</th>
                <th>Estado</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td class="text-center">
                    {{-- Estética similar a la imagen del carrusel pero con icono --}}
                    <div style="width:80px; height:60px; display:flex; align-items:center; justify-content:center; background:#f8f9fa; border-radius:8px; margin:auto;">
                        <i class="{{ $item->icono }} {{ $item->color_icono }} fs-2"></i>
                    </div>
                </td>
                <td class="text-center"><code>{{ $item->icono }}</code></td>
                <td>{{ $item->titulo }}</td>
                <td>{{ $item->texto }}</td>
                <td>{{ $item->orden }}</td>
                <td>
                    <button class="btn btn-primary" onclick="abrirModalEditar({{ $item->id }}, `{{ $item->titulo }}`, `{{ $item->texto }}`, `{{ $item->icono }}`, `{{ $item->color_icono }}`, {{ $item->orden }})">
                        <i class="fa fa-pencil"></i>
                    </button>
                </td>
                <td>
                    <button class="btn {{ $item->is_active ? 'btn-danger' : 'btn-success' }}" onclick="toggleEstado({{ $item->id }})">
                        {{ $item->is_active ? 'Desactivar' : 'Activar' }}
                    </button>
                </td>
                <td>
                    <button class="btn btn-dark" onclick="eliminar({{ $item->id }})">Eliminar</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- MODAL ÚNICO (Diseño idéntico al Carrusel) --}}
<div class="modal fade" id="modalBEN" tabindex="-1">
    <div class="modal-dialog">
        <form id="formBEN">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Formulario Beneficio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id">

                    <label>Título</label>
                    <input type="text" id="titulo" class="form-control" placeholder="Ej: Pagos Digitales">

                    <label class="mt-2">Texto</label>
                    <textarea id="texto" class="form-control" rows="2" placeholder="Descripción breve..."></textarea>

                    <div class="row">
                        <div class="col-md-6">
                            <label class="mt-2">Icono (Clase)</label>
                            <input type="text" id="icono" class="form-control" placeholder="bi bi-cash">
                        </div>
                        <div class="col-md-6">
                            <label class="mt-2">Color Icono</label>
                            <input type="text" id="color_icono" class="form-control" placeholder="text-success">
                        </div>
                    </div>

                    <label class="mt-2">Orden</label>
                    <input type="number" id="orden" class="form-control">
                    
                    {{-- Preview del icono en tiempo real --}}
                    <div id="previewContainer" class="mt-3 text-center" style="display: none; background: #eee; padding: 20px; border-radius: 10px;">
                        <i id="iconPreview" class="fs-1"></i>
                        <p class="small text-muted mt-2">Vista previa del icono</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.3.7/js/dataTables.js"></script>

<script>
$(document).ready(function () {
    $('#tablaBeneficios').DataTable();
});

function abrirModalNuevo() {
    $('#formBEN')[0].reset();
    $('#id').val('');
    $('#modalTitle').text('Agregar Nuevo Beneficio');
    $('#previewContainer').hide();
    $('#modalBEN').modal('show');
}

function abrirModalEditar(id, titulo, texto, icono, color, orden) {
    $('#formBEN')[0].reset();
    $('#id').val(id);
    $('#modalTitle').text('Editar Beneficio');
    $('#titulo').val(titulo);
    $('#texto').val(texto);
    $('#icono').val(icono);
    $('#color_icono').val(color);
    $('#orden').val(orden);
    
    // Actualizar preview
    $('#iconPreview').attr('class', icono + ' ' + color + ' fs-1');
    $('#previewContainer').show();
    
    $('#modalBEN').modal('show');
}

// Lógica de validación TRIM y envío (Igual a tu Carrusel)
$('#formBEN').on('submit', function(e) {
    e.preventDefault();

    let id = $('#id').val();
    let titulo = $('#titulo').val().trim();
    let texto = $('#texto').val().trim();
    let icono = $('#icono').val().trim();
    let color = $('#color_icono').val().trim();
    let orden = $('#orden').val();

    if (!titulo || !texto || !icono || !orden) {
        alert('Todos los campos son obligatorios y no pueden estar vacíos.');
        return;
    }

    let formData = new FormData();
    formData.append('_token', '{{ csrf_token() }}');
    formData.append('titulo', titulo);
    formData.append('texto', texto);
    formData.append('icono', icono);
    formData.append('color_icono', color);
    formData.append('orden', orden);

    let url = id ? '/beneficios/' + id : '/beneficios/store';
    if (id) formData.append('_method', 'PUT');

    fetch(url, {
        method: 'POST',
        body: formData,
        headers: { 'Accept': 'application/json' }
    })
    .then(r => r.json())
    .then(d => {
        if (d.error) { alert(d.msg); } 
        else { location.reload(); }
    });
});

// Listener para ver el icono mientras escribes
$('#icono, #color_icono').on('input', function() {
    let ico = $('#icono').val();
    let col = $('#color_icono').val();
    if(ico) {
        $('#iconPreview').attr('class', ico + ' ' + col + ' fs-1');
        $('#previewContainer').show();
    }
});

function toggleEstado(id){ fetch('/beneficios-toggle/' + id).then(() => location.reload()); }

function eliminar(id){
    if(confirm("¿Eliminar este registro permanentemente?")){
        fetch('/beneficios/' + id, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        }).then(() => location.reload());
    }
}
</script>
@endsection