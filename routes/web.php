<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\NuestrosComerciantesController;
use App\Http\Controllers\AprendeAUsarController;
use App\Http\Controllers\PrincipalController;

use App\Http\Controllers\Administrador\AuthController;
use App\Http\Controllers\Administrador\DashboardController;

use App\Http\Controllers\ComentarioController;

use App\Http\Controllers\Administrador\QuienesSomosController;

use App\Http\Controllers\Administrador\CarruselPaginaPrincipalController;

use App\Http\Controllers\Administrador\ProductoController;

use App\Http\Controllers\Administrador\PorqueElegirnosController;

use App\Http\Controllers\Administrador\BeneficioController;

use App\Http\Controllers\Administrador\TipoDeServicioController;


// Ruta principal
Route::get('/', function () {
    return view('welcome');
});

// Rutas de Conoce Más
Route::get('/inicio', [HomeController::class,'inicio'])->name('inicio');
Route::get('/registro', [HomeController::class,'Registro'])->name('registro');
Route::get('/carrito', [HomeController::class,'Carrito'])->name('carrito');
Route::get('/ayuda', [HomeController::class,'Ayuda'])->name('ayuda');
Route::get('/contacto', [PostController::class, 'Contacto'])->name('contacto');

// Rutas de Nuestros Comerciantes
Route::get('/cerca_mi', [NuestrosComerciantesController::class, 'Cerca_Mi'])->name('cerca_mi');
Route::get('/mejor_calificados', [NuestrosComerciantesController::class, 'Mejor_Calificados'])->name('mejor_calificados');
Route::get('/nuevos_comerciantes', [NuestrosComerciantesController::class, 'Nuevos_Comerciantes'])->name('nuevos_comerciantes');

// Rutas de Aprende a Usar
Route::get('/clientes', [AprendeAUsarController::class, 'Clientes'])->name('clientes');
Route::get('/comerciantes', [AprendeAUsarController::class, 'Comerciantes'])->name('comerciantes');
Route::get('/pagos', [AprendeAUsarController::class, 'Pagos'])->name('pagos');

// Ruta de Producto individual
Route::get('/producto/{slug}', function($slug) {
    return "Producto: " . $slug;
})->name('producto');

Route::get('/productos/{categoria?}', [CategoriaController::class, 'Productos'])->name('productos');

Route::get('/subcategorias/{categoria}', [CategoriaController::class, 'SubcategoriasAjax']);


Route::get('/login/admin', [AuthController::class, 'login'])->name('login');
Route::post('/login/admin', [AuthController::class, 'loginPost']);

Route::get('/registrar/admin', [AuthController::class, 'register']);
Route::post('/registrar/admin', [AuthController::class, 'saveRegister']);

Route::get('/quienes-somos', [QuienesSomosController::class, 'publico']);

Route::get('/comentarios', [ComentarioController::class, 'index'])->name('comentarios');
Route::post('/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');


/*
|--------------------------------------------------------------------------
| 🔐 DASHBOARD (ADMIN + INVITADO)
|--------------------------------------------------------------------------
*/

Route::middleware([
    \App\Http\Middleware\Administrador\AuthAdmin::class,
    'session.timeout'
])
->prefix('dashboard')
->group(function () {

    // 🏠 DASHBOARD PRINCIPAL (Ambos entran)
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // 🚪 LOGOUT
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    /*
    |--------------------------------------------------------------------------
    | RUTAS PROTEGIDAS POR ROL (Solo Admin puede modificar)
    |--------------------------------------------------------------------------
    */
    
    // 🧾 QUIENES SOMOS
    Route::prefix('quienes-somos')->group(function () {
        Route::get('/', [QuienesSomosController::class, 'index']); // Invitado ve la lista
        
        // Solo Admin guarda, edita o borra
        Route::middleware('role:admin')->group(function() {
            Route::post('/store', [QuienesSomosController::class, 'store']);
            Route::put('/{id}', [QuienesSomosController::class, 'update']);
            Route::get('/toggle/{id}', [QuienesSomosController::class, 'toggle']);
            Route::delete('/{id}', [QuienesSomosController::class, 'destroy']);
        });
    });

    // 📦 PRODUCTOS
    Route::prefix('productos')->group(function () {
        Route::get('/', [ProductoController::class, 'index']); // Invitado ve la lista
        Route::get('/create', [ProductoController::class, 'create']); // Invitado puede ver el form si quieres

        Route::middleware('role:admin')->group(function() {
            Route::post('/store', [ProductoController::class, 'store']);
            Route::put('/{id}', [ProductoController::class, 'update']);
            Route::delete('/{id}', [ProductoController::class, 'destroy']);
            Route::get('/toggle/{id}', [ProductoController::class, 'toggle']);
            Route::get('/destacado/{id}', [ProductoController::class, 'toggleDestacado']);
        });
    });

    // 🎠 CARRUSEL
    Route::prefix('carrusel')->group(function () {
        Route::get('/', [CarruselPaginaPrincipalController::class, 'index']);
        
        Route::middleware('role:admin')->group(function() {
            Route::post('/store', [CarruselPaginaPrincipalController::class, 'store']);
            Route::put('/{id}', [CarruselPaginaPrincipalController::class, 'update']);
            Route::get('/toggle/{id}', [CarruselPaginaPrincipalController::class, 'toggle']);
            Route::delete('/{id}', [CarruselPaginaPrincipalController::class, 'destroy']);
        });
    });

    // 🎁 BENEFICIOS
    Route::prefix('beneficios')->group(function () {
        Route::get('/', [BeneficioController::class, 'index']);

        Route::middleware('role:admin')->group(function() {
            Route::post('/store', [BeneficioController::class, 'store']);
            Route::put('/{id}', [BeneficioController::class, 'update']);
            Route::get('/toggle/{id}', [BeneficioController::class, 'toggle']);
            Route::delete('/{id}', [BeneficioController::class, 'destroy']);
        });
    });

    // ⭐ PORQUE ELEGIRNOS Y SERVICIOS (Siguen el mismo patrón)
    Route::prefix('porque-elegirnos')->group(function () {
        Route::get('/', [PorqueElegirnosController::class, 'index']);
        Route::middleware('role:admin')->post('/store', [PorqueElegirnosController::class, 'store']);
        // ... repites middleware('role:admin') para put, toggle y delete
    });

    
    // 🧰 TIPOS DE SERVICIOS (YA CORREGIDO)
    
    Route::prefix('tipos-servicios')->group(function () {

        Route::get('/admin', [TipoDeServicioController::class, 'index']);

        Route::middleware('role:admin')->group(function () {
            Route::post('/store', [TipoDeServicioController::class, 'store']);
            Route::put('/{id}', [TipoDeServicioController::class, 'update']);
            Route::get('/toggle/{id}', [TipoDeServicioController::class, 'toggle']);
            Route::delete('/{id}', [TipoDeServicioController::class, 'destroy']);
        });

    });

    
});
/* 
Rutas comentadas de ejemplo
Route::get('/', function () {
    return view('welcome');
})->name('vista_inicio');

Route::get('/contact', function () {
    $nombre = "Alejandro Góngora Escalante";
    return view('contact', [
        'nombre' => $nombre,
        'carrera' => 'Doctor en Sistemas Computacionales'
    ]);
})->name('contact');
*/