@extends('layouts.app')

@section('title', 'Editar Socio')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('socio.mostrar') }}" class="btn btn-light me-3">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="h3 mb-0">Editar Socio</h1>
            </div>

            <div class="card">
                <div class="card-body p-4">
                    <form action="{{ route('socio.update', $socio) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <!-- DNI -->
                            <div class="col-md-4 mb-4">
                                <label for="dni" class="form-label">DNI</label>
                                <input type="text" 
                                       class="form-control @error('dni') is-invalid @enderror" 
                                       id="dni" 
                                       name="dni" 
                                       value="{{ old('dni', $socio->dni) }}"
                                       placeholder="Ingrese DNI"
                                       maxlength="8"
                                       required>
                                @error('dni')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Nombres -->
                            <div class="col-md-4 mb-4">
                                <label for="nombres" class="form-label">Nombres</label>
                                <input type="text" 
                                       class="form-control @error('nombres') is-invalid @enderror" 
                                       id="nombres" 
                                       name="nombres" 
                                       value="{{ old('nombres', $socio->nombres) }}"
                                       placeholder="Ingrese nombres"
                                       required>
                                @error('nombres')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Apellidos -->
                            <div class="col-md-4 mb-4">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" 
                                       class="form-control @error('apellidos') is-invalid @enderror" 
                                       id="apellidos" 
                                       name="apellidos" 
                                       value="{{ old('apellidos', $socio->apellidos) }}"
                                       placeholder="Ingrese apellidos"
                                       required>
                                @error('apellidos')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Dirección -->
                            <div class="col-md-6 mb-4">
                                <label for="direccion" class="form-label">Dirección</label>
                                <input type="text" 
                                       class="form-control @error('direccion') is-invalid @enderror" 
                                       id="direccion" 
                                       name="direccion" 
                                       value="{{ old('direccion', $socio->direccion) }}"
                                       placeholder="Ingrese dirección"
                                       required>
                                @error('direccion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Sexo -->
                            <div class="col-md-3 mb-4">
                                <label for="sexo" class="form-label">Sexo</label>
                                <select class="form-select @error('sexo') is-invalid @enderror" 
                                        id="sexo" 
                                        name="sexo" 
                                        required>
                                    <option value="">Seleccione sexo</option>
                                    <option value="Masculino" {{ old('sexo', $socio->sexo) == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                    <option value="Femenino" {{ old('sexo', $socio->sexo) == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                </select>
                                @error('sexo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Fecha de nacimiento -->
                            <div class="col-md-3 mb-4">
                                <label for="fechanacimiento" class="form-label">Fecha de Nacimiento</label>
                                <input type="date" 
                                       class="form-control @error('fechanacimiento') is-invalid @enderror" 
                                       id="fechanacimiento" 
                                       name="fechanacimiento" 
                                       value="{{ old('fechanacimiento', $socio->fechanacimiento) }}"
                                       required
                                       onchange="calcularEdad()">
                                @error('fechanacimiento')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Edad -->
                            <div class="col-md-3 mb-4">
                                <label for="edad" class="form-label">Edad</label>
                                <input type="number" 
                                       class="form-control @error('edad') is-invalid @enderror" 
                                       id="edad" 
                                       name="edad" 
                                       value="{{ old('edad', $socio->edad) }}"
                                       readonly
                                       required>
                                @error('edad')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Estado -->
                            <div class="col-md-3 mb-4">
                                <label for="estado" class="form-label">Estado</label>
                                <select class="form-select @error('estado') is-invalid @enderror" 
                                        id="estado" 
                                        name="estado" 
                                        required>
                                    <option value="Vigente" {{ old('estado', $socio->estado) == 'Vigente' ? 'selected' : '' }}>Vigente</option>
                                    <option value="Inactivo" {{ old('estado', $socio->estado) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                                </select>
                                @error('estado')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('socio.mostrar') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function calcularEdad() {
        const nacimiento = document.getElementById('fechanacimiento').value;
        if (nacimiento) {
            const hoy = new Date();
            const fechaNac = new Date(nacimiento);
            let edad = hoy.getFullYear() - fechaNac.getFullYear();
            const m = hoy.getMonth() - fechaNac.getMonth();
            if (m < 0 || (m === 0 && hoy.getDate() < fechaNac.getDate())) {
                edad--;
            }
            document.getElementById('edad').value = edad;
        }
    }
</script>

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
    }

    .btn-light {
        background-color: #f8f9fa;
        border-color: #f8f9fa;
    }

    .btn-light:hover {
        background-color: #e9ecef;
        border-color: #e9ecef;
    }
</style>
@endsection
