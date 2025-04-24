@extends('layouts.app')

@section('title', 'Socios')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Gestión de Socios</h1>
        <link rel="stylesheet" href="{{ asset('css/formone.css') }}">
        <a href="{{ route('socio.registro') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Nuevo Socio
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">DNI</th>
                            <th scope="col">Nombres</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Sexo</th>
                            <th scope="col">Fecha de Nacimiento</th>
                            <th scope="col">Edad</th>
                            <th scope="col">Dirección</th>
                            <th scope="col" class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($socios as $socio)
                            <tr>
                                <td>{{ $socio->dni }}</td>
                                <td>{{ $socio->nombres }}</td>
                                <td>{{ $socio->apellidos }}</td>
                                <td>{{ $socio->sexo }}</td>
                                <td>{{ \Carbon\Carbon::parse($socio->fechanacimiento)->format('d/m/Y') }}</td>
                                <td>{{ $socio->edad }} años</td>
                                <td>{{ $socio->direccion ?? 'N/A' }}</td>
                                <td>
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('socio.edit', $socio->idsocios) }}" class="btn btn-warning btn-sm" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('socio.destroy', $socio->idsocios) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este socio?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-3 text-muted">
                                    No hay socios registrados
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
