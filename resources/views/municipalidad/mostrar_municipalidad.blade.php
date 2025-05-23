@extends('layouts.app')

@section('title', 'Municipalidades')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Gestión de Municipalidades</h1>
        <link rel="stylesheet" href="{{ asset('css/formone.css') }}">
        <a href="{{ route('municipalidad.registro') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Nueva Municipalidad
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Razón Social</th>
                            <th scope="col">RUC</th>
                            <th scope="col">Dirección</th>
                            <th scope="col">Representante</th>
                            <th scope="col">Estado</th>
                            <th scope="col" class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($municipalidades as $municipalidad)
                            <tr>
                                <td>{{ $municipalidad->razonsocial }}</td>
                                <td>{{ $municipalidad->ruc }}</td>
                                <td>{{ $municipalidad->direccion }}</td>
                                <td>{{ $municipalidad->representante }}</td>
                                <td>
                                    <span class="badge bg-success rounded-pill">
                                        {{ $municipalidad->estado }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('municipalidad.edit', $municipalidad) }}" class="btn btn-warning btn-sm" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('municipalidad.destroy', $municipalidad) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar" 
                                                onclick="return confirm('¿Está seguro que desea eliminar esta municipalidad?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-3 text-muted">
                                    No hay municipalidades registradas
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
