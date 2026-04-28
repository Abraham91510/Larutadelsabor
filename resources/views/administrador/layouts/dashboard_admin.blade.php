<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>

<!-- Fuentes -->
<link href="https://fonts.googleapis.com/css2?family=Nunito&family=Poppins:wght@700&family=Lilita+One&display=swap" rel="stylesheet">

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<!-- Font Awesome (por si usas fa fa-...) -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<!-- FontAwesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">


 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.6/css/dataTables.dataTables.css">

<style>

/* ===== TUS ESTILOS ===== */
.fondo { background: #2D9F4F; }
.img-responsive { width: 100%; height: 100%; }

body { font-family: 'Nunito', sans-serif !important; margin:0; background:#f4f6f9; }
h1 { font-family: 'Lilita One', cursive !important; }
h2, h3, h4, h5, h6 { font-family: 'Poppins', sans-serif !important; font-weight: 700; }

/* ===== SIDEBAR ===== */
.sidebar{
    width:260px;
    height:100vh;
    background:#2D9F4F;
    color:white;
    position:fixed;
    display:flex;
    flex-direction:column;
    transition:0.3s;
}

.sidebar.collapsed{ width:80px; }

/* BOTÓN */
.toggle-btn{
    position:absolute;
    top:20px;
    right:-15px;
    background:#1b7a3a;
    width:30px;
    height:30px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    cursor:pointer;
}

/* EMPRESA */
.empresa{
    text-align:center;
    padding:20px 10px;
    border-bottom:1px solid rgba(255,255,255,0.2);
}

.empresa img{ width:60px; margin-bottom:10px; }

/* USUARIO */
.usuario{
    text-align:center;
    padding:20px 10px;
    border-bottom:1px solid rgba(255,255,255,0.2);
}

.usuario img{
    width:60px;
    border-radius:50%;
    margin-bottom:10px;
}

/* MENU */
.menu{
    flex:1;
    overflow-y:auto;
    padding-bottom:40px;
}

.menu ul{ list-style:none; padding:0; margin:0; }

.menu li{
    padding:15px 20px;
    cursor:pointer;
    transition:0.3s;
}

.menu li:hover{ background:rgba(0,0,0,0.2); }

.menu i{ margin-right:10px; }

/* SCROLL BONITO */
.menu::-webkit-scrollbar { width:6px; }
.menu::-webkit-scrollbar-thumb {
    background: rgba(255,255,255,0.3);
    border-radius:10px;
}

/* ===== MAIN ===== */
.main{
    position: relative;
    margin-left:260px;
    padding-left:0;
    min-height:100vh;
    transition:0.3s;
    width: calc(100% - 260px);
}

.main.expanded{
    margin-left:80px;
    width: calc(100% - 80px);
}

/* CONTENT */
.content{
    padding:20px;
    transition:0.3s;
}

/* CARDS */
.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));
    gap:20px;
}

.card{
    background:white;
    padding:20px;
    border-radius:10px;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
    transition:0.3s;
}

.card:hover{ transform:translateY(-5px); }

.card i{
    font-size:28px;
    color:#2D9F4F;
    margin-bottom:10px;
}

/* ===== FOOTER ===== */
.social-hover:hover,
.link-hover:hover { 
    color: #FFC107 !important; 
    transform: scale(1.2); 
    transition: all 0.3s ease; 
}

.footer-dark{
    background:#0A0A0A;
    color:white;
}

/* COLAPSADO */
.sidebar.collapsed .empresa h4,
.sidebar.collapsed .empresa small,
.sidebar.collapsed .usuario h5,
.sidebar.collapsed .usuario small,
.sidebar.collapsed .menu span{
    display:none;
}

.sidebar.collapsed .empresa img,
.sidebar.collapsed .usuario img{
    width:40px;
}

body{
    overflow-x:hidden;
}

.sidebar, .main{
    transition: all 0.3s ease;
}

</style>
</head>

<body>



<div class="sidebar" id="sidebar">

    <div class="toggle-btn" onclick="toggleSidebar()">
        <i class="fas fa-chevron-left" id="iconToggle"></i>
    </div>

    <div class="empresa d-flex align-items-center gap-3 p-3">

    <!-- LOGO -->
    <img src="{{ asset($generales->logo_empresa ?? 'logo.png') }}"
         style="width:50px; height:50px; object-fit:contain; background:white; border-radius:10px; padding:5px;">

    <!-- TEXTO -->
    <div style="text-align:left;">
        <div style="font-size:14px; font-weight:700; color:white;">
            {{ $generales->nombre_empresa ?? 'Empresa' }}
        </div>

        <div style="font-size:11px; color:rgba(255,255,255,0.75);">
            {{ $generales->eslogan_empresa ?? '' }}
        </div>
    </div>

</div>

    <div class="usuario text-center p-2">
        <img src="{{ asset('Imagenes/' . ($user->foto ?? 'default.png')) }}" 
             style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
        <h6 style="font-size:12px; margin-top:5px; color: white;">
            {{ $user->name ?? 'Invitado' }}
        </h6>
        <small class="badge {{ ($user->role ?? 'invitado') == 'admin' ? 'bg-danger' : 'bg-secondary' }}" style="font-size:9px;">
            {{ strtoupper($user->role ?? 'invitado') }}
        </small>
    </div>

    <div class="menu">
        <ul class="list-unstyled">
           @foreach($menuDashboard as $opcion)
                @php
                    // Solo mostramos la opción si tiene subopciones visibles (ya filtradas por el controlador)
                    // o si es una opción directa con URL (como el Dashboard)
                    $tieneSub = $opcion->subopciones->count() > 0;
                @endphp

               @php
    $tieneSub = $opcion->subopciones->count() > 0;
    $url = $opcion->url ?? '#';
@endphp

<li
    onclick="{!! $tieneSub
        ? 'toggleMenu(' . $opcion->id . ')'
        : "window.location.href='{$url}'" !!}"
    style="display:flex; justify-content:space-between; align-items:center; padding:12px 15px; font-size:12px; cursor:pointer; color: white;"
>
                    
                    <div>
                        <i class="{{ $opcion->icono }} me-2" style="font-size:14px; width: 20px;"></i>
                        <span>{{ $opcion->nombre }}</span>
                    </div>

                    @if($tieneSub)
                        <i class="fas fa-chevron-down" id="icon-{{ $opcion->id }}" style="font-size:10px;"></i>
                    @endif
                </li>

                @if($tieneSub)
                    <ul id="submenu-{{ $opcion->id }}" class="list-unstyled bg-dark" style="display:none;">
                        @foreach($opcion->subopciones as $sub)
                            <li style="padding:0;">
                                <a href="{{ url($sub->url) }}" 
                                   style="color:#ccc; text-decoration:none; display:block; padding:8px 20px; font-size:11px; transition: 0.3s;"
                                   onmouseover="this.style.color='white'; this.style.backgroundColor='rgba(255,255,255,0.1)'"
                                   onmouseout="this.style.color='#ccc'; this.style.backgroundColor='transparent'">
                                    <i class="{{ $sub->icono }} me-2" style="font-size:11px;"></i>
                                    {{ $sub->nombre }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            @endforeach
        </ul>
    </div>

    <div style="margin-top:auto; padding:15px; text-align:center; font-size:10px; background:#000; color:#fff; border-top:1px solid rgba(255,255,255,0.2);">
        <div>{{ $generales->descripcion_empresa ?? '' }}</div>
        <div style="margin-top:5px;">
            <i class="{{ $generales->derechos_reservados_empresa['icono'] ?? 'bi bi-c-circle' }}"></i>
            {{ $generales->derechos_reservados_empresa['anio'] ?? date('Y') }}
            {{ $generales->derechos_reservados_empresa['texto'] ?? 'Todos los derechos reservados' }}
        </div>
    </div>
</div>


<!-- MAIN -->
<div class="main" id="main">

    <div class="navbar">
        <h6 class="m-0">@yield('titulopagina', 'Dashboard')</h6>
    </div>

    <div class="content">
        @yield('content')
    </div>

</div>
<script>
function toggleSidebar(){
    let sidebar = document.getElementById("sidebar");
    let main = document.getElementById("main");
    let icon = document.getElementById("iconToggle");

    sidebar.classList.toggle("collapsed");
    main.classList.toggle("expanded");

    icon.classList.toggle("fa-chevron-left");
    icon.classList.toggle("fa-chevron-right");
}
</script>

<script>
function toggleMenu(id){
    let menu = document.getElementById("submenu-" + id);
    let icon = document.getElementById("icon-" + id);

    if(menu.style.display === "none"){
        menu.style.display = "block";
        icon.classList.remove("fa-chevron-down");
        icon.classList.add("fa-chevron-up");
    } else {
        menu.style.display = "none";
        icon.classList.remove("fa-chevron-up");
        icon.classList.add("fa-chevron-down");
    }
}
</script>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.3.7/js/dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.userway.org/widget.js" data-account="SwcLPv3GeL"></script>
@yield('scripts')
</body>
</html>