@extends('layouts.app')

@section('title', 'Registrar Comité')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('comite.mostrar') }}" class="btn btn-light me-3">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="h3 mb-0">Registrar Nuevo Comité</h1>
            </div>

            <div class="card">
                <div class="card-body p-4">
                <form action="{{ route('comite.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="codigo" class="form-label">Código</label>
                            <input type="text" 
                                class="form-control @error('codigo') is-invalid @enderror" 
                                id="codigo" 
                                name="codigo" 
                                value="{{ old('codigo') }}"
                                placeholder="Ingrese el código del comité">
                            @error('codigo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="nombre" class="form-label">Nombre del Comité</label>
                            <input type="text" 
                                class="form-control @error('nombre') is-invalid @enderror" 
                                id="nombre" 
                                name="nombre" 
                                value="{{ old('nombre') }}"
                                placeholder="Ingrese el nombre del comité">
                            @error('nombre')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="coordinadora" class="form-label">Coordinadora</label>
                            <input type="text" 
                                class="form-control @error('coordinadora') is-invalid @enderror" 
                                id="coordinadora" 
                                name="coordinadora" 
                                value="{{ old('coordinadora') }}"
                                placeholder="Ingrese el nombre de la coordinadora">
                            @error('coordinadora')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="idmunicipalidad" class="form-label">Municipalidad</label>
                            <select class="form-select @error('idmunicipalidad') is-invalid @enderror" 
                                    id="idmunicipalidad" 
                                    name="idmunicipalidad" 
                                    required>
                                <option value="">Seleccione una municipalidad</option>
                                @foreach($municipalidades as $municipalidad)
                                    <option value="{{ $municipalidad->idmunicipalidad }}" 
                                            {{ old('idmunicipalidad') == $municipalidad->idmunicipalidad ? 'selected' : '' }}>
                                        {{ $municipalidad->razonsocial }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idmunicipalidad')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Guardar Comité
                        </button>
                    </div>
                </form>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: #333;
    }

    .form-control, .form-select {
        border: 1px solid #dee2e6;
        border-radius: 4px;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.2rem rgba(25, 118, 210, 0.1);
    }

    .form-control.is-invalid, .form-select.is-invalid {
        border-color: var(--danger);
        padding-right: calc(1.5em + 0.75rem);
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right calc(0.375em + 0.1875rem) center;
        background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
    }

    textarea.form-control {
        min-height: 100px;
    }

    .invalid-feedback {
        font-size: 0.875rem;
        color: var(--danger);
        margin-top: 0.25rem;
    }

    .btn-light {
        background-color: #f8f9fa;
        border-color: #f8f9fa;
        padding: 0.5rem;
        line-height: 1;
        border-radius: 4px;
    }

    .btn-light:hover {
        background-color: #e9ecef;
        border-color: #e9ecef;
    }
</style>
@endsection
