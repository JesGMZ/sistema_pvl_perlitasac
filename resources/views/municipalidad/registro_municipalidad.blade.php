@extends('layouts.app')

@section('title', 'Registrar Municipalidad')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('municipalidad.mostrar') }}" class="btn btn-light me-3">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="h3 mb-0">Registrar Nueva Municipalidad</h1>
            </div>

            <div class="card">
                <div class="card-body p-4">
                    <form action="{{ route('municipalidad.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="razonsocial" class="form-label">Razón Social</label>
                                <input type="text" 
                                       class="form-control @error('razonsocial') is-invalid @enderror" 
                                       id="razonsocial" 
                                       name="razonsocial" 
                                       value="{{ old('razonsocial') }}"
                                       placeholder="Ingrese la razón social"
                                       required>
                                @error('razonsocial')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="ruc" class="form-label">RUC</label>
                                <input type="text" 
                                       class="form-control @error('ruc') is-invalid @enderror" 
                                       id="ruc" 
                                       name="ruc" 
                                       value="{{ old('ruc') }}"
                                       placeholder="Ingrese el RUC"
                                       maxlength="11"
                                       required>
                                @error('ruc')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-12 mb-4">
                                <label for="direccion" class="form-label">Dirección</label>
                                <input type="text" 
                                       class="form-control @error('direccion') is-invalid @enderror" 
                                       id="direccion" 
                                       name="direccion" 
                                       value="{{ old('direccion') }}"
                                       placeholder="Ingrese la dirección"
                                       required>
                                @error('direccion')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-12 mb-4">
                                <label for="representante" class="form-label">Representante</label>
                                <input type="text" 
                                       class="form-control @error('representante') is-invalid @enderror" 
                                       id="representante" 
                                       name="representante" 
                                       value="{{ old('representante') }}"
                                       placeholder="Ingrese el nombre del representante"
                                       required>
                                @error('representante')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <input type="hidden" name="estado" value="Vigente">

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Guardar Municipalidad
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

    .form-control {
        border: 1px solid #dee2e6;
        border-radius: 4px;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }

    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.2rem rgba(25, 118, 210, 0.1);
    }

    .form-control.is-invalid {
        border-color: var(--danger);
        padding-right: calc(1.5em + 0.75rem);
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right calc(0.375em + 0.1875rem) center;
        background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
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
