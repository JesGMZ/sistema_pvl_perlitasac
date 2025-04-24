@extends('layouts.app')

@section('title', 'Registros Vaso de Leche')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Registros del Programa Vaso de Leche</h1>
        <link rel="stylesheet" href="{{ asset('css/formone.css') }}">
        <a href="{{ route('programa.registro') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Nuevo Registro
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Mes</th>
                            <th scope="col">Beneficiario</th>
                            <th scope="col">Comité</th>
                            <th scope="col">Estado</th>
                            <th scope="col" class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pvls as $pvl)
                            <tr>
                                <td>{{ $pvl->id }}</td>
                                <td>{{ \Carbon\Carbon::parse($pvl->fecha)->format('d/m/Y') }}</td>
                                <td>{{ $pvl->mes }}</td>
                                <td>{{ $pvl->beneficiario->nombres ?? 'No asignado' }}</td>
                                <td>{{ $pvl->comite->nombre ?? 'No asignado' }}</td>
                                <td>
                                    <span class="badge bg-{{ $pvl->estado == 'Vigente' ? 'success' : 'secondary' }} rounded-pill">
                                        {{ $pvl->estado }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('programa.edit', $pvl) }}" class="btn btn-warning btn-sm" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('programa.destroy', $pvl) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar" 
                                                onclick="return confirm('¿Está seguro que desea eliminar este registro del programa?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-3 text-muted">
                                    No hay registros disponibles
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
