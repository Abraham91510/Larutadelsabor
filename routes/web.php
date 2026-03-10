<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\NuestrosComerciantesController;
use App\Http\Controllers\AprendeAUsarController;
use App\Http\Controllers\PrincipalController;

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

// Rutas de Categorías
Route::get('/comida', [CategoriaController::class, 'Comida'])->name('comida');
Route::get('/snack', [CategoriaController::class, 'Snack'])->name('snack');
Route::get('/postre', [CategoriaController::class, 'Postre'])->name('postre');
Route::get('/panaderia', [CategoriaController::class, 'Panaderia'])->name('panaderia');
Route::get('/producto_temporada', [CategoriaController::class, 'Producto_Temporada'])->name('producto_temporada');
Route::get('/bebida', [CategoriaController::class, 'Bebida'])->name('bebida');

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