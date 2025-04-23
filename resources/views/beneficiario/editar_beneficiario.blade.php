@extends('layouts.app')

@section('title', 'Editar Beneficiario')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10">
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('beneficiario.mostrar') }}" class="btn btn-light me-3">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="h3 mb-0">Editar Beneficiario</h1>
            </div>

            <div class="card">
                <div class="card-body p-4">
                    <form action="{{ route('beneficiario.update', $beneficiario) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Nombres -->
                            <div class="col-md-4 mb-3">
                                <label for="nombres" class="form-label">Nombres</label>
                                <input type="text" class="form-control @error('nombres') is-invalid @enderror" 
                                       id="nombres" name="nombres" value="{{ old('nombres', $beneficiario->nombres) }}" 
                                       placeholder="Ingrese nombres" required>
                                @error('nombres') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Apellidos -->
                            <div class="col-md-4 mb-3">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" class="form-control @error('apellidos') is-invalid @enderror" 
                                       id="apellidos" name="apellidos" value="{{ old('apellidos', $beneficiario->apellidos) }}" 
                                       placeholder="Ingrese apellidos" required>
                                @error('apellidos') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Dirección -->
                            <div class="col-md-4 mb-3">
                                <label for="direccion" class="form-label">Dirección</label>
                                <input type="text" class="form-control @error('direccion') is-invalid @enderror" 
                                       id="direccion" name="direccion" value="{{ old('direccion', $beneficiario->direccion) }}" 
                                       placeholder="Ingrese dirección">
                                @error('direccion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Parentesco -->
                            <div class="col-md-4 mb-3">
                                <label for="parentesco" class="form-label">Parentesco</label>
                                <input type="text" class="form-control @error('parentesco') is-invalid @enderror" 
                                       id="parentesco" name="parentesco" value="{{ old('parentesco', $beneficiario->parentesco) }}" 
                                       placeholder="Ej. Hijo, Esposo, etc." required>
                                @error('parentesco') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Sexo -->
                            <div class="col-md-4 mb-3">
                                <label for="sexo" class="form-label">Sexo</label>
                                <select class="form-select @error('sexo') is-invalid @enderror" 
                                        id="sexo" name="sexo" required>
                                    <option value="Masculino" {{ old('sexo', $beneficiario->sexo) == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                    <option value="Femenino" {{ old('sexo', $beneficiario->sexo) == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                </select>
                                @error('sexo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Categoría -->
                            <div class="col-md-4 mb-3">
                                <label for="idcategoria" class="form-label">Categoría</label>
                                <select class="form-select @error('idcategoria') is-invalid @enderror" 
                                        id="idcategoria" name="idcategoria" required>
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->idcategoria }}"
                                            {{ old('idcategoria', $beneficiario->idcategoria) == $categoria->idcategoria ? 'selected' : '' }}>
                                            {{ $categoria->descategoria }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('idcategoria') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Socio -->
                            <div class="col-md-6 mb-3">
                                <label for="idsocios" class="form-label">Socio</label>
                                <select class="form-select @error('idsocios') is-invalid @enderror" 
                                        id="idsocios" name="idsocios" required>
                                    @foreach($socios as $socio)
                                        <option value="{{ $socio->idsocios }}"
                                            {{ old('idsocios', $beneficiario->idsocios) == $socio->idsocios ? 'selected' : '' }}>
                                            {{ $socio->nombres }} {{ $socio->apellidos }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('idsocios') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Fecha de nacimiento -->
                            <div class="col-md-3 mb-3">
                                <label for="fechanacimiento" class="form-label">Fecha de Nacimiento</label>
                                <input type="date" class="form-control @error('fechanacimiento') is-invalid @enderror" 
                                       id="fechanacimiento" name="fechanacimiento" value="{{ old('fechanacimiento', $beneficiario->fechanacimiento) }}" 
                                       required onchange="calcularEdad()">
                                @error('fechanacimiento') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Edad -->
                            <div class="col-md-2 mb-3">
                                <label for="edad" class="form-label">Edad</label>
                                <input type="number" class="form-control @error('edad') is-invalid @enderror" 
                                       id="edad" name="edad" value="{{ old('edad', $beneficiario->edad) }}" readonly required>
                                @error('edad') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Estado -->
                            <div class="col-md-3 mb-3">
                                <label for="estado" class="form-label">Estado</label>
                                <select class="form-select @error('estado') is-invalid @enderror" 
                                        id="estado" name="estado" required>
                                    <option value="Vigente" {{ old('estado', $beneficiario->estado) == 'Vigente' ? 'selected' : '' }}>Vigente</option>
                                    <option value="Inactivo" {{ old('estado', $beneficiario->estado) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                                </select>
                                @error('estado') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4 gap-2">
                            <a href="{{ route('beneficiario.mostrar') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
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
@endsection
