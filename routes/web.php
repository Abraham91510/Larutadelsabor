<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\NuestrosComerciantesController;
use App\Http\Controllers\AprendeAUsarController;
use App\Http\Controllers\PrincipalController;



use App\Http\Controllers\CarritoController;




use App\Http\Controllers\Usuario\AuthController as UsuarioAuthController;

use App\Http\Controllers\Administrador\AuthController as AdminAuthController;

use App\Http\Controllers\Usuario\CaptchaController as UsuarioCaptchaController;

use App\Http\Controllers\Administrador\CaptchaController as AdminCaptchaController;




use App\Http\Controllers\Administrador\DashboardController;

use App\Http\Controllers\ComentarioController;

use App\Http\Controllers\Administrador\QuienesSomosController;

use App\Http\Controllers\Administrador\CarruselPaginaPrincipalController;

use App\Http\Controllers\Administrador\ProductoController;

use App\Http\Controllers\Administrador\PorqueElegirnosController;

use App\Http\Controllers\Administrador\BeneficioController;

use App\Http\Controllers\Administrador\TipoDeServicioController;



/*
|--------------------------------------------------------------------------
| 👤 LOGIN / REGISTRO USUARIO (FUERA DE PLATAFORMA)
|--------------------------------------------------------------------------
*/

Route::get('/login/usuario', [UsuarioAuthController::class, 'login'])
    ->name('usuario.login');

Route::post('/login/usuario', [UsuarioAuthController::class, 'loginPost']);

Route::get('/registrar/usuario', [UsuarioAuthController::class, 'register'])
    ->name('usuario.registro');

Route::post('/registrar/usuario', [UsuarioAuthController::class, 'saveRegister']);

Route::get('/captcha-simple/usuario', [UsuarioCaptchaController::class, 'generate'])
    ->name('usuario.captcha.simple');

Route::get('/quienes-somos/usuario', [QuienesSomosController::class, 'publico'])
    ->name('usuario.quienes_somos');


/*
|--------------------------------------------------------------------------
| 👥 PLATAFORMA (CLIENTE + COMERCIANTE)
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth.usuario',
    'session.timeout.usuario'
])
->prefix('plataforma')
->group(function () {

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

// PRODUCTO DETALLE
Route::get('/producto/{slug}', [CategoriaController::class, 'show'])
    ->name('producto');

// CARRITO
Route::get('/carrito', [CarritoController::class, 'index'])
    ->name('carrito');

Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])
    ->name('carrito.agregar');

Route::post('/carrito/actualizar', [CarritoController::class, 'actualizar'])
    ->name('carrito.actualizar');

Route::post('/carrito/sumar/{id}', [CarritoController::class, 'sumar'])
    ->name('carrito.sumar');

Route::post('/carrito/restar/{id}', [CarritoController::class, 'restar'])
    ->name('carrito.restar');

Route::post('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])
    ->name('carrito.eliminar');

Route::get('/productos/{categoria?}', [CategoriaController::class, 'Productos'])->name('productos');

Route::get('/subcategorias/{categoria}', [CategoriaController::class, 'SubcategoriasAjax']);

    /*
    |--------------------------------------------------------------------------
    | 💬 SOLO CLIENTE
    |--------------------------------------------------------------------------
    */

    Route::middleware('role.usuario:cliente')->group(function () {

       Route::get('/comentarios', [ComentarioController::class, 'index'])->name('comentarios');
Route::post('/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');


    });

});


Route::get('/login/admin', [AdminAuthController::class, 'login'])->name('login');

Route::post('/login/admin', [AdminAuthController::class, 'loginPost']);

Route::get('/registrar/admin', [AdminAuthController::class, 'register']);

Route::post('/registrar/admin', [AdminAuthController::class, 'saveRegister']);

Route::get('/captcha-simple', [AdminCaptchaController::class, 'generate'])
    ->name('captcha.simple');


Route::get('/quienes-somos', [QuienesSomosController::class, 'publico']);




/*
|--------------------------------------------------------------------------
| 🔐 DASHBOARD (ADMIN + INVITADO)
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth.admin',
    'session.timeout.admin'
])
->prefix('dashboard')
->group(function () {

    // 🏠 DASHBOARD PRINCIPAL (Ambos entran)
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // 🚪 LOGOUT
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    /*
    |--------------------------------------------------------------------------
    | RUTAS PROTEGIDAS POR ROL (Solo Admin puede modificar)
    |--------------------------------------------------------------------------
    */
    
    // 🧾 QUIENES SOMOS
    Route::prefix('quienes-somos')->group(function () {
        Route::get('/', [QuienesSomosController::class, 'index']); // Invitado ve la lista
        
        // Solo Admin guarda, edita o borra
        Route::middleware('role.admin:admin')->group(function() {
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

        Route::middleware('role.admin:admin')->group(function() {
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
        
        Route::middleware('role.admin:admin')->group(function() {
            Route::post('/store', [CarruselPaginaPrincipalController::class, 'store']);
            Route::put('/{id}', [CarruselPaginaPrincipalController::class, 'update']);
            Route::get('/toggle/{id}', [CarruselPaginaPrincipalController::class, 'toggle']);
            Route::delete('/{id}', [CarruselPaginaPrincipalController::class, 'destroy']);
        });
    });

    // 🎁 BENEFICIOS
    Route::prefix('beneficios')->group(function () {
        Route::get('/', [BeneficioController::class, 'index']);

        Route::middleware('role.admin:admin')->group(function() {
            Route::post('/store', [BeneficioController::class, 'store']);
            Route::put('/{id}', [BeneficioController::class, 'update']);
            Route::get('/toggle/{id}', [BeneficioController::class, 'toggle']);
            Route::delete('/{id}', [BeneficioController::class, 'destroy']);
        });
    });

    // ⭐ PORQUE ELEGIRNOS Y SERVICIOS (Siguen el mismo patrón)
    Route::prefix('porque-elegirnos')->group(function () {
        Route::get('/', [PorqueElegirnosController::class, 'index']);
        Route::middleware('role.admin:admin')->post('/store', [PorqueElegirnosController::class, 'store']);
        // ... repites middleware('role.admin:admin') para put, toggle y delete
    });

    
    // 🧰 TIPOS DE SERVICIOS (YA CORREGIDO)
    
    Route::prefix('tipos-servicios')->group(function () {

        Route::get('/admin', [TipoDeServicioController::class, 'index']);

        Route::middleware('role.admin:admin')->group(function () {
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