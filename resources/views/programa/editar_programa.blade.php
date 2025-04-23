@extends('layouts.app')

@section('title', 'Editar Programa')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('programa.mostrar') }}" class="btn btn-light me-3">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="h3 mb-0">Editar Programa Vaso de Leche</h1>
            </div>

            <div class="card">
                <div class="card-body p-4">
                    <form action="{{ route('programa.update', $pvl) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Fecha -->
                            <div class="col-md-6 mb-4">
                                <label for="fecha" class="form-label">Fecha</label>
                                <input type="date" 
                                       class="form-control @error('fecha') is-invalid @enderror" 
                                       id="fecha" 
                                       name="fecha" 
                                       value="{{ old('fecha', $pvl->fecha) }}" 
                                       required>
                                @error('fecha')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Mes -->
                            <div class="col-md-6 mb-4">
                                <label for="mes" class="form-label">Mes</label>
                                <input type="text" 
                                    class="form-control" 
                                    id="mes_display" 
                                    value="{{ old('mes', $pvl->mes) }}" 
                                    readonly 
                                    style="background-color: #f1f1f1; cursor: not-allowed;">
                                <input type="hidden" name="mes" id="mes_hidden" value="{{ old('mes', $pvl->mes) }}">
                            </div>
                            <!-- Beneficiario -->
                            <div class="col-md-6 mb-4">
                                <label for="idbeneficiarios" class="form-label">Beneficiario</label>
                                <select class="form-select @error('idbeneficiarios') is-invalid @enderror" id="idbeneficiarios" name="idbeneficiarios" required>
                                    <option value="">Seleccione un beneficiario</option>
                                    @foreach($beneficiarios as $beneficiario)
                                        <option value="{{ $beneficiario->idbeneficiarios }}" 
                                            {{ old('idbeneficiarios', $pvl->idbeneficiarios) == $beneficiario->idbeneficiarios ? 'selected' : '' }}>{{ $beneficiario->nombres }}</option>
                                    @endforeach
                                </select>
                                @error('idbeneficiarios')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Comité -->
                            <div class="col-md-6 mb-4">
                                <label for="idcomite" class="form-label">Comité</label>
                                <select class="form-select @error('idcomite') is-invalid @enderror" id="idcomite" name="idcomite" required>
                                    <option value="">Seleccione un comité</option>
                                    @foreach($comites as $comite)
                                        <option value="{{ $comite->idcomite }}" 
                                            {{ old('idcomite', $pvl->idcomite) == $comite->idcomite ? 'selected' : '' }}>{{ $comite->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('idcomite')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('programa.mostrar') }}" class="btn btn-secondary me-2">Cancelar</a>
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
document.addEventListener('DOMContentLoaded', function () {
    const fechaInput = document.getElementById('fecha');
    const mesDisplay = document.getElementById('mes_display');
    const mesHidden = document.getElementById('mes_hidden');

    const meses = [
        'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
    ];

    fechaInput.addEventListener('change', function () {
        const fecha = new Date(this.value);
        if (!isNaN(fecha)) {
            const mesNombre = meses[fecha.getMonth()];
            mesDisplay.value = mesNombre; 
            mesHidden.value = mesNombre;  
        }
    });

    const fechaInicial = new Date("{{ old('fecha', $pvl->fecha) }}");
    if (!isNaN(fechaInicial)) {
        const mesNombre = meses[fechaInicial.getMonth()];
        mesDisplay.value = mesNombre;
        mesHidden.value = mesNombre;
    }
});
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
        padding-right: calc(1.5em + 0.75rem);
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right calc(0.375em + 0.1875rem) center;
        background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
    }
</style>
@endsection
