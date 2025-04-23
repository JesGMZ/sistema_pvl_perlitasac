@extends('layouts.app')

@section('title', 'Registrar Beneficiario')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10">
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('beneficiario.mostrar') }}" class="btn btn-light me-3">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="h3 mb-0">Registrar Nuevo Beneficiario</h1>
            </div>

            <div class="card">
                <div class="card-body p-4">
                    <form action="{{ route('beneficiario.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <!-- DNI -->
                            <div class="col-md-4 mb-3">
                                <label for="dni" class="form-label">DNI</label>
                                <input type="text" class="form-control @error('dni') is-invalid @enderror" 
                                       id="dni" name="dni" value="{{ old('dni') }}" maxlength="8"
                                       placeholder="Ingrese DNI" required>
                                @error('dni') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Nombres -->
                            <div class="col-md-4 mb-3">
                                <label for="nombres" class="form-label">Nombres</label>
                                <input type="text" class="form-control @error('nombres') is-invalid @enderror" 
                                       id="nombres" name="nombres" value="{{ old('nombres') }}" 
                                       placeholder="Ingrese nombres" required>
                                @error('nombres') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Apellidos -->
                            <div class="col-md-4 mb-3">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" class="form-control @error('apellidos') is-invalid @enderror" 
                                       id="apellidos" name="apellidos" value="{{ old('apellidos') }}" 
                                       placeholder="Ingrese apellidos" required>
                                @error('apellidos') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Dirección -->
                            <div class="col-md-6 mb-3">
                                <label for="direccion" class="form-label">Dirección</label>
                                <input type="text" class="form-control @error('direccion') is-invalid @enderror"
                                       id="direccion" name="direccion" value="{{ old('direccion') }}"
                                       placeholder="Ingrese dirección" required>
                                @error('direccion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Parentesco -->
                            <div class="col-md-6 mb-3">
                                <label for="parentesco" class="form-label">Parentesco</label>
                                <input type="text" class="form-control @error('parentesco') is-invalid @enderror"
                                       id="parentesco" name="parentesco" value="{{ old('parentesco') }}"
                                       placeholder="Ej. Hijo, Esposo, etc." required>
                                @error('parentesco') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Fecha de nacimiento -->
                            <div class="col-md-4 mb-3">
                                <label for="fechanacimiento" class="form-label">Fecha de Nacimiento</label>
                                <input type="date" class="form-control @error('fechanacimiento') is-invalid @enderror"
                                       id="fechanacimiento" name="fechanacimiento" value="{{ old('fechanacimiento') }}"
                                       required onchange="calcularEdad()">
                                @error('fechanacimiento') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Edad (calculado automáticamente) -->
                            <div class="col-md-2 mb-3">
                                <label for="edad" class="form-label">Edad</label>
                                <input type="number" class="form-control @error('edad') is-invalid @enderror"
                                       id="edad" name="edad" value="{{ old('edad') }}" readonly required>
                                @error('edad') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Sexo -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Sexo</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sexo" id="sexo_m" value="Masculino" {{ old('sexo') == 'Masculino' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="sexo_m">Masculino</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sexo" id="sexo_f" value="Femenino" {{ old('sexo') == 'Femenino' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="sexo_f">Femenino</label>
                                </div>
                                @error('sexo') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>

                            <!-- Categoría -->
                            <div class="col-md-6 mb-3">
                                <label for="idcategoria" class="form-label">Categoría</label>
                                <select class="form-select @error('idcategoria') is-invalid @enderror" id="idcategoria" name="idcategoria" required>
                                    <option value="">Seleccione una categoría</option>
                                    @foreach($categorias as $cat)
                                        <option value="{{ $cat->idcategoria }}" {{ old('idcategoria') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->descategoria }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('idcategoria') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Socio -->
                            <div class="col-md-6 mb-3">
                                <label for="idsocios" class="form-label">Socio</label>
                                <select class="form-select @error('idsocios') is-invalid @enderror" id="idsocios" name="idsocios" required>
                                    <option value="">Seleccione un socio</option>
                                    @foreach($socios as $socio)
                                        <option value="{{ $socio->idsocios }}" {{ old('idsocios') == $socio->id ? 'selected' : '' }}>
                                            {{ $socio->nombres }} {{ $socio->apellidos }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('idsocios') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Guardar Beneficiario
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
    const fechaNacimiento = document.getElementById('fechanacimiento').value;
    if (fechaNacimiento) {
        const hoy = new Date();
        const nacimiento = new Date(fechaNacimiento);
        let edad = hoy.getFullYear() - nacimiento.getFullYear();
        const mes = hoy.getMonth() - nacimiento.getMonth();
        if (mes < 0 || (mes === 0 && hoy.getDate() < nacimiento.getDate())) {
            edad--;
        }
        document.getElementById('edad').value = edad;
    }
}
</script>
@endsection
