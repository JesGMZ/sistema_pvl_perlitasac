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
use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/reporte/{mes}', [DashboardController::class, 'generarReporte'])->name('dashboard.reporte');
Route::get('/dashboard/entregas-data', [DashboardController::class, 'getEntregasDataJson'])->name('dashboard.entregas-data');
Route::get('/dashboard/pvls-por-comite', [DashboardController::class, 'getPvlsPorComite'])->name('dashboard.pvls-por-comite');

// Rutas para Categoría
Route::prefix('categoria')->group(function () {
    Route::get('/registro', [CategoriaController::class, 'registro'])->name('categoria.registro');
    Route::post('/store', [CategoriaController::class, 'store'])->name('categoria.store');
    Route::get('/mostrar', [CategoriaController::class, 'mostrar'])->name('categoria.mostrar');
    Route::get('/editar/{categoria}', [CategoriaController::class, 'edit'])->name('categoria.edit');
    Route::put('/actualizar/{categoria}', [CategoriaController::class, 'update'])->name('categoria.update');
    Route::delete('/eliminar/{categoria}', [CategoriaController::class, 'destroy'])->name('categoria.destroy');
});

// Rutas para Beneficiario
Route::prefix('beneficiario')->group(function () {
    Route::get('/registro', [BeneficiarioController::class, 'registro'])->name('beneficiario.registro');
    Route::post('/store', [BeneficiarioController::class, 'store'])->name('beneficiario.store');
    Route::get('/mostrar', [BeneficiarioController::class, 'mostrar'])->name('beneficiario.mostrar');
    Route::get('/editar/{beneficiario}', [BeneficiarioController::class, 'edit'])->name('beneficiario.edit');
    Route::put('/actualizar/{beneficiario}', [BeneficiarioController::class, 'update'])->name('beneficiario.update');
    Route::delete('/eliminar/{beneficiario}', [BeneficiarioController::class, 'destroy'])->name('beneficiario.destroy');
});

// Rutas para Comité
Route::prefix('comite')->group(function () {
    Route::get('/registro', [ComiteController::class, 'registro'])->name('comite.registro');
    Route::post('/store', [ComiteController::class, 'store'])->name('comite.store');
    Route::get('/mostrar', [ComiteController::class, 'mostrar'])->name('comite.mostrar');
    Route::get('/editar/{comite}', [ComiteController::class, 'edit'])->name('comite.edit');
    Route::put('/actualizar/{comite}', [ComiteController::class, 'update'])->name('comite.update');
    Route::delete('/eliminar/{comite}', [ComiteController::class, 'destroy'])->name('comite.destroy');
});

// Rutas para Detalle Programa
Route::prefix('detalle-programa')->group(function () {
    Route::get('/registro', [DetalleProgramaController::class, 'registro'])->name('detalle-programa.registro');
    Route::post('/store', [DetalleProgramaController::class, 'store'])->name('detalle-programa.store');
    Route::get('/mostrar', [DetalleProgramaController::class, 'mostrar'])->name('detalle-programa.mostrar');
    Route::get('/editar/{detalle}', [DetalleProgramaController::class, 'edit'])->name('detalle-programa.edit');
    Route::put('/actualizar/{detalle}', [DetalleProgramaController::class, 'update'])->name('detalle-programa.update');
    Route::delete('/eliminar/{detalle}', [DetalleProgramaController::class, 'destroy'])->name('detalle-programa.destroy');
});

// Rutas para Municipalidad
Route::prefix('municipalidad')->group(function () {
    Route::get('/registro', [MunicipalidadController::class, 'registro'])->name('municipalidad.registro');
    Route::post('/store', [MunicipalidadController::class, 'store'])->name('municipalidad.store');
    Route::get('/mostrar', [MunicipalidadController::class, 'mostrar'])->name('municipalidad.mostrar');
    Route::get('/editar/{municipalidad}', [MunicipalidadController::class, 'edit'])->name('municipalidad.edit');
    Route::put('/actualizar/{municipalidad}', [MunicipalidadController::class, 'update'])->name('municipalidad.update');
    Route::delete('/eliminar/{municipalidad}', [MunicipalidadController::class, 'destroy'])->name('municipalidad.destroy');
});

// Rutas para Producto
Route::prefix('producto')->group(function () {
    Route::get('/registro', [ProductoController::class, 'registro'])->name('producto.registro');
    Route::post('/store', [ProductoController::class, 'store'])->name('producto.store');
    Route::get('/mostrar', [ProductoController::class, 'mostrar'])->name('producto.mostrar');
    Route::get('/editar/{producto}', [ProductoController::class, 'edit'])->name('producto.edit');
    Route::put('/actualizar/{producto}', [ProductoController::class, 'update'])->name('producto.update');
    Route::delete('/eliminar/{producto}', [ProductoController::class, 'destroy'])->name('producto.destroy');
});

// Rutas para Programa Vaso de Leche
Route::prefix('programa')->group(function () {
    Route::get('/registro', [Programa_vaso_de_lecheController::class, 'registro'])->name('programa.registro');
    Route::post('/store', [Programa_vaso_de_lecheController::class, 'store'])->name('programa.store');
    Route::get('/mostrar', [Programa_vaso_de_lecheController::class, 'mostrar'])->name('programa.mostrar');
    Route::get('/editar/{pvl}', [Programa_vaso_de_lecheController::class, 'edit'])->name('programa.edit');
    Route::put('/actualizar/{pvl}', [Programa_vaso_de_lecheController::class, 'update'])->name('programa.update');
    Route::delete('/eliminar/{pvl}', [Programa_vaso_de_lecheController::class, 'destroy'])->name('programa.destroy');
});

// Rutas para Socio
Route::prefix('socio')->group(function () {
    Route::get('/registro', [SocioController::class, 'registro'])->name('socio.registro');
    Route::post('/store', [SocioController::class, 'store'])->name('socio.store');
    Route::get('/mostrar', [SocioController::class, 'mostrar'])->name('socio.mostrar');
    Route::get('/editar/{socio}', [SocioController::class, 'edit'])->name('socio.edit');
    Route::put('/actualizar/{socio}', [SocioController::class, 'update'])->name('socio.update');
    Route::delete('/eliminar/{socio}', [SocioController::class, 'destroy'])->name('socio.destroy');
});

// Rutas para Usuario
Route::prefix('usuario')->group(function () {
    Route::get('/registro', [UsuarioController::class, 'registro'])->name('usuario.registro');
    Route::post('/store', [UsuarioController::class, 'store'])->name('usuario.store');
    Route::get('/mostrar', [UsuarioController::class, 'mostrar'])->name('usuario.mostrar');
    Route::get('/editar/{usuario}', [UsuarioController::class, 'edit'])->name('usuario.edit');
    Route::put('/actualizar/{usuario}', [UsuarioController::class, 'update'])->name('usuario.update');
    Route::delete('/eliminar/{usuario}', [UsuarioController::class, 'destroy'])->name('usuario.destroy');
});
