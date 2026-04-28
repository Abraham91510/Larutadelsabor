@extends('administrador.layouts.dashboard_admin')

@section('content')
<h2>Listado Quiénes Somos</h2>

<button class="btn btn-success mb-3" onclick="abrirModalNuevo()">
    <i class="fa fa-plus"></i> Agregar nuevo
</button>

<div class="table-responsive">
    <table id="tablaQS" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Icono</th>
                <th>Tipo</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Acciones</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>
                    @if($item->imagen)
                        <img src="/{{ $item->imagen }}" style="width:80px;height:60px;object-fit:cover;border-radius:8px;">
                    @endif
                </td>
                <td style="font-size:20px;"><i class="{{ $item->icono }}"></i></td>
                <td>{{ $item->tipo }}</td>
                <td>{{ $item->titulo }}</td>
                <td>{{ \Illuminate\Support\Str::limit($item->descripcion, 40) }}</td>
                <td>
                    <button class="btn {{ $item->is_active ? 'btn-danger' : 'btn-success' }} btn-sm" onclick="toggleEstado({{ $item->id }})">
                        {{ $item->is_active ? 'Desactivar' : 'Activar' }}
                    </button>
                </td>
                <td>
                    <button class="btn btn-primary btn-sm" onclick="abrirModal({{ $item->id }}, '{{ $item->tipo }}', `{{ $item->titulo }}`, `{{ $item->descripcion }}`, '{{ $item->icono }}', '{{ $item->imagen }}')">
                        <i class="fa fa-pencil"></i>
                    </button>
                </td>
                <td>
                    <button class="btn btn-dark btn-sm" onclick="eliminar({{ $item->id }})">Eliminar</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="modalQS" tabindex="-1">
    <div class="modal-dialog">
        <form id="formQS" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Formulario Quiénes Somos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id">
                    <label>Tipo</label>
                    <input type="text" id="tipo" class="form-control">
                    <label class="mt-2">Título</label>
                    <input type="text" id="titulo" class="form-control">
                    <label class="mt-2">Descripción</label>
                    <textarea id="descripcion" class="form-control" rows="3"></textarea>
                    <label class="mt-2">Icono</label>
                    <input type="text" id="icono" class="form-control">
                    
                    <label class="mt-2">Imagen</label>
                    <input type="file" id="imagenInput" class="form-control" accept="image/*">
                    
                    <div id="previewContainer" class="mt-3 text-center" style="position: relative; display: none;">
                        <img id="imgPreview" style="width: 100%; border-radius: 10px; max-height: 200px; object-fit: cover;">
                        <button type="button" class="btn btn-danger btn-sm" id="btnQuitarImg" style="position: absolute; top: 5px; right: 5px;">&times;</button>
                    </div>
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

@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.3.7/js/dataTables.js"></script>

<script>
$(document).ready(function () { $('#tablaQS').DataTable(); });

let dt = new DataTransfer();
let imagenExistenteUrl = "";

function abrirModal(id, tipo, titulo, descripcion, icono, imagen){
    $('#formQS')[0].reset();
    dt = new DataTransfer(); // Limpiar archivos seleccionados
    $('#id').val(id);
    $('#tipo').val(tipo);
    $('#titulo').val(titulo);
    $('#descripcion').val(descripcion);
    $('#icono').val(icono);
    $('#modalTitle').text('Editar Información');
    
    imagenExistenteUrl = imagen;
    if(imagen && imagen !== "null"){
        $('#imgPreview').attr('src', '/' + imagen);
        $('#previewContainer').show();
        $('#btnQuitarImg').hide(); // No quitar la que ya existe en BD desde aquí
    } else {
        $('#previewContainer').hide();
    }
    $('#modalQS').modal('show');
}

function abrirModalNuevo(){
    $('#formQS')[0].reset();
    $('#id').val('');
    $('#modalTitle').text('Agregar Nuevo Elemento');
    dt = new DataTransfer();
    imagenExistenteUrl = "";
    $('#previewContainer').hide();
    $('#modalQS').modal('show');
}

// Manejo de Selección de Imagen
$('#imagenInput').on('change', function () {
    if (this.files && this.files[0]) {
        dt = new DataTransfer();
        dt.items.add(this.files[0]);
        this.files = dt.files;

        let reader = new FileReader();
        reader.onload = e => {
            $('#imgPreview').attr('src', e.target.result);
            $('#previewContainer').show();
            $('#btnQuitarImg').show();
        };
        reader.readAsDataURL(this.files[0]);
    }
});

// Quitar imagen seleccionada
$('#btnQuitarImg').on('click', function() {
    dt = new DataTransfer();
    $('#imagenInput')[0].files = dt.files;
    if (imagenExistenteUrl) {
        $('#imgPreview').attr('src', '/' + imagenExistenteUrl);
        $(this).hide();
    } else {
        $('#previewContainer').hide();
    }
});

$('#formQS').on('submit', function (e) {
    e.preventDefault();

    let id = $('#id').val();
    let tipo = $('#tipo').val().trim();
    let titulo = $('#titulo').val().trim();
    let descripcion = $('#descripcion').val().trim();
    let icono = $('#icono').val().trim();

    // CONDICIÓN 1: Textos obligatorios
    if (!tipo || !titulo || !descripcion || !icono) {
        alert('Todos los campos de texto son obligatorios.');
        return;
    }

    // CONDICIÓN 2: Imagen obligatoria si es NUEVO
    if (!id && dt.files.length === 0) {
        alert('Debes subir una imagen para crear un nuevo registro.');
        return;
    }

    let formData = new FormData();
    formData.append('_token', '{{ csrf_token() }}');
    formData.append('tipo', tipo);
    formData.append('titulo', titulo);
    formData.append('descripcion', descripcion);
    formData.append('icono', icono);

    if (dt.files.length > 0) {
        formData.append('imagen', dt.files[0]);
    }

    let url = id ? '/quienessomos/' + id : '/quienessomos-store';
    if (id) { formData.append('_method', 'PUT'); }

    fetch(url, { method: 'POST', body: formData })
    .then(res => res.json())
    .then(data => {
        if (data.success) { location.reload(); } 
        else { alert('Error: ' + data.error); }
    })
    .catch(() => alert('Error en servidor'));
});

function toggleEstado(id){ fetch('/quienessomos-toggle/' + id).then(() => location.reload()); }

function eliminar(id){
    if(confirm("¿Eliminar este registro?")){
        fetch('/quienessomos/' + id, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        }).then(() => location.reload());
    }
}
</script>
@endsection