@extends('layouts.app')

@section('title', 'Registrar Socio')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('socio.mostrar') }}" class="btn btn-light me-3">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="h3 mb-0">Registrar Nuevo Socio</h1>
            </div>

            <div class="card">
                <div class="card-body p-4">
                    <form action="{{ route('socio.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="dni" class="form-label">DNI</label>
                                <input type="text" 
                                       class="form-control @error('dni') is-invalid @enderror" 
                                       id="dni" 
                                       name="dni" 
                                       value="{{ old('dni') }}"
                                       placeholder="Ingrese el DNI"
                                       maxlength="8"
                                       required>
                                @error('dni')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="nombres" class="form-label">Nombres</label>
                                <input type="text" 
                                       class="form-control @error('nombres') is-invalid @enderror" 
                                       id="nombres" 
                                       name="nombres" 
                                       value="{{ old('nombres') }}"
                                       placeholder="Ingrese los nombres"
                                       required>
                                @error('nombres')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" 
                                       class="form-control @error('apellidos') is-invalid @enderror" 
                                       id="apellidos" 
                                       name="apellidos" 
                                       value="{{ old('apellidos') }} "
                                       placeholder="Ingrese los apellidos"
                                       required>
                                @error('apellidos')
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
                                       placeholder="Ingrese la dirección">
                                @error('direccion')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                                <input type="date" 
                                       class="form-control @error('fecha_nacimiento') is-invalid @enderror" 
                                       id="fecha_nacimiento" 
                                       name="fecha_nacimiento" 
                                       value="{{ old('fecha_nacimiento') }}"
                                       required onchange="calcularEdad()">
                                @error('fecha_nacimiento')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="edad" class="form-label">Edad</label>
                                <input type="text" 
                                       class="form-control @error('edad') is-invalid @enderror" 
                                       id="edad" 
                                       name="edad" 
                                       value="{{ old('edad') }}"
                                       placeholder="Edad"
                                       readonly>
                                @error('edad')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="sexo" class="form-label">Sexo</label>
                                <select class="form-control @error('sexo') is-invalid @enderror" 
                                        id="sexo" 
                                        name="sexo" 
                                        required>
                                    <option value="" disabled selected>Seleccione el sexo</option>
                                    <option value="masculino" {{ old('sexo') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                                    <option value="femenino" {{ old('sexo') == 'femenino' ? 'selected' : '' }}>Femenino</option>
                                </select>
                                @error('sexo')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Guardar Socio
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

    /* Estilos específicos para inputs de tipo date */
    input[type="date"] {
        padding: 0.6rem 1rem;
    }

    input[type="date"]::-webkit-calendar-picker-indicator {
        margin-left: 0.5rem;
        cursor: pointer;
    }
</style>

<script>
    function calcularEdad() {
        const fechaNacimiento = document.getElementById('fecha_nacimiento').value;
        const fechaNacimientoObj = new Date(fechaNacimiento);
        const today = new Date();
        let edad = today.getFullYear() - fechaNacimientoObj.getFullYear();
        const m = today.getMonth() - fechaNacimientoObj.getMonth();
        
        // Ajuste si aún no ha cumplido años este año
        if (m < 0 || (m === 0 && today.getDate() < fechaNacimientoObj.getDate())) {
            edad--;
        }

        document.getElementById('edad').value = edad;
    }
</script>

@endsection
