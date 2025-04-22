<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\BeneficiarioController;
use App\Http\Controllers\ComiteController;
use App\Http\Controllers\DetalleProgramaController;
use App\Http\Controllers\MunicipalidadController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\Programa_vaso_de_lecheController;
use App\Http\Controllers\SocioController;
use App\Http\Controllers\UsuarioController;

Route::get('/', function () {
    return view('welcome');
});

// Rutas para Categoría
Route::prefix('categoria')->group(function () {
    Route::get('/registro', [CategoriaController::class, 'registro'])->name('categoria.registro');
    Route::post('/store', [CategoriaController::class, 'store'])->name('categoria.store');
    Route::get('/mostrar', [CategoriaController::class, 'mostrar'])->name('categoria.mostrar');
});

// Rutas para Beneficiario
Route::prefix('beneficiario')->group(function () {
    Route::get('/registro', [BeneficiarioController::class, 'registro'])->name('beneficiario.registro');
    Route::post('/store', [BeneficiarioController::class, 'store'])->name('beneficiario.store');
    Route::get('/mostrar', [BeneficiarioController::class, 'mostrar'])->name('beneficiario.mostrar');
});

// Rutas para Comité
Route::prefix('comite')->group(function () {
    Route::get('/registro', [ComiteController::class, 'registro'])->name('comite.registro');
    Route::post('/store', [ComiteController::class, 'store'])->name('comite.store');
    Route::get('/mostrar', [ComiteController::class, 'mostrar'])->name('comite.mostrar');
});

// Rutas para Detalle Programa
Route::prefix('detalle-programa')->group(function () {
    Route::get('/registro', [DetalleProgramaController::class, 'registro'])->name('detalle-programa.registro');
    Route::post('/store', [DetalleProgramaController::class, 'store'])->name('detalle-programa.store');
    Route::get('/mostrar', [DetalleProgramaController::class, 'mostrar'])->name('detalle-programa.mostrar');
});

// Rutas para Municipalidad
Route::prefix('municipalidad')->group(function () {
    Route::get('/registro', [MunicipalidadController::class, 'registro'])->name('municipalidad.registro');
    Route::post('/store', [MunicipalidadController::class, 'store'])->name('municipalidad.store');
    Route::get('/mostrar', [MunicipalidadController::class, 'mostrar'])->name('municipalidad.mostrar');
});

// Rutas para Producto
Route::prefix('producto')->group(function () {
    Route::get('/registro', [ProductoController::class, 'registro'])->name('producto.registro');
    Route::post('/store', [ProductoController::class, 'store'])->name('producto.store');
    Route::get('/mostrar', [ProductoController::class, 'mostrar'])->name('producto.mostrar');
});

// Rutas para Programa Vaso de Leche
Route::prefix('programa')->group(function () {
    Route::get('/registro', [Programa_vaso_de_lecheController::class, 'registro'])->name('programa.registro');
    Route::post('/store', [Programa_vaso_de_lecheController::class, 'store'])->name('programa.store');
    Route::get('/mostrar', [Programa_vaso_de_lecheController::class, 'mostrar'])->name('programa.mostrar');
});

// Rutas para Socio
Route::prefix('socio')->group(function () {
    Route::get('/registro', [SocioController::class, 'registro'])->name('socio.registro');
    Route::post('/store', [SocioController::class, 'store'])->name('socio.store');
    Route::get('/mostrar', [SocioController::class, 'mostrar'])->name('socio.mostrar');
});

// Rutas para Usuario
Route::prefix('usuario')->group(function () {
    Route::get('/registro', [UsuarioController::class, 'registro'])->name('usuario.registro');
    Route::post('/store', [UsuarioController::class, 'store'])->name('usuario.store');
    Route::get('/mostrar', [UsuarioController::class, 'mostrar'])->name('usuario.mostrar');
});
