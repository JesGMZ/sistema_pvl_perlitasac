@extends('layouts.app')

@section('title', 'Programa Vaso de Leche Completo')

@section('content')
<div class="container-fluid">
    <!-- Sección de Programas PVL -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Registros del Programa Vaso de Leche</h1>
        <a href="{{ route('programa.registro') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Nuevo Registro
        </a>
    </div>

    <div class="card mb-5">
        <div class="card-body">
            @include('programa.mostrar_programa')  <!-- Incluye tu vista actual de programas -->
        </div>
    </div>

    <!-- Sección de Entregas -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Entregas</h1>
        <a href="{{ route('detalle-programa.registro') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Nueva Entrega
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            @include('detalle.mostrar_detalle')  <!-- Incluye tu vista actual de detalles -->
        </div>
    </div>
</div>
@endsection