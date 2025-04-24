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

@endsection
