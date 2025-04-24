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
