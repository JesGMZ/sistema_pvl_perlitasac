@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Dashboard</h1>
            <p class="text-muted small mb-0">Bienvenido al sistema de administración del Programa Vaso de Leche</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <select class="form-select form-select-sm" id="mesSelector" style="width: 140px;">
                @php
                    $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
                    $mesActual = now()->format('n') - 1;
                    $anioActual = now()->format('Y');
                @endphp
                <option value="{{ now()->format('Y-m') }}">{{ $meses[$mesActual] }} {{ $anioActual }}</option>
            </select>
            <button class="btn btn-primary btn-sm px-3">
                Generar Reporte
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <!-- Total Beneficiarios -->
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 bg-white">
                <div class="card-body">
                    <div class="d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted">Total Beneficiarios</span>
                            <div class="rounded-circle bg-primary bg-opacity-10 p-2">
                                <i class="fas fa-users text-primary"></i>
                            </div>
                        </div>
                        <h3 class="mb-1">{{ number_format($totalBeneficiarios) }}</h3>
                        @if($beneficiariosGrowth > 0)
                            <div class="d-flex align-items-center">
                                <i class="fas fa-arrow-up text-success me-1"></i>
                                <span class="text-success">+{{ number_format($beneficiariosGrowth, 1) }}% desde el mes pasado</span>
                            </div>
                        @elseif($beneficiariosGrowth < 0)
                            <div class="d-flex align-items-center">
                                <i class="fas fa-arrow-down text-danger me-1"></i>
                                <span class="text-danger">{{ number_format(abs($beneficiariosGrowth), 1) }}% desde el mes pasado</span>
                            </div>
                        @else
                            <div class="d-flex align-items-center">
                                <span class="text-muted">Sin cambios desde el mes pasado</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Distribución Mensual -->
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 bg-white">
                <div class="card-body">
                    <div class="d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted">Distribución Mensual</span>
                            <div class="rounded-circle bg-success bg-opacity-10 p-2">
                                <i class="fas fa-box text-success"></i>
                            </div>
                        </div>
                        <h3 class="mb-1">{{ number_format($totalDistribucion, 1) }} kg</h3>
                        @if($distribucionGrowth > 0)
                            <div class="d-flex align-items-center">
                                <i class="fas fa-arrow-up text-success me-1"></i>
                                <span class="text-success">+{{ number_format($distribucionGrowth, 1) }}% desde el mes pasado</span>
                            </div>
                        @elseif($distribucionGrowth < 0)
                            <div class="d-flex align-items-center">
                                <i class="fas fa-arrow-down text-danger me-1"></i>
                                <span class="text-danger">{{ number_format(abs($distribucionGrowth), 1) }}% desde el mes pasado</span>
                            </div>
                        @else
                            <div class="d-flex align-items-center">
                                <span class="text-muted">Sin cambios desde el mes pasado</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Comités Activos -->
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 bg-white">
                <div class="card-body">
                    <div class="d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted">Comités Activos</span>
                            <div class="rounded-circle bg-info bg-opacity-10 p-2">
                                <i class="fas fa-home text-info"></i>
                            </div>
                        </div>
                        <h3 class="mb-1">{{ $comitesActivos }}</h3>
                        <div class="d-flex align-items-center">
                            <span class="text-muted">0% desde el mes pasado</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alertas -->
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 bg-white">
                <div class="card-body">
                    <div class="d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted">Alertas</span>
                            <div class="rounded-circle bg-warning bg-opacity-10 p-2">
                                <i class="fas fa-exclamation-triangle text-warning"></i>
                            </div>
                        </div>
                        <h3 class="mb-1">{{ $stockBajo }}</h3>
                        @if($alertasGrowth > 0)
                            <div class="d-flex align-items-center">
                                <i class="fas fa-arrow-up text-danger me-1"></i>
                                <span class="text-danger">+{{ number_format($alertasGrowth, 1) }}% desde el mes pasado</span>
                            </div>
                        @elseif($alertasGrowth < 0)
                            <div class="d-flex align-items-center">
                                <i class="fas fa-arrow-down text-success me-1"></i>
                                <span class="text-success">{{ number_format(abs($alertasGrowth), 1) }}% desde el mes pasado</span>
                            </div>
                        @else
                            <div class="d-flex align-items-center">
                                <span class="text-muted">Sin cambios desde el mes pasado</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts & Activity -->
    <div class="row g-3">
        <!-- Distribution Chart -->
        <div class="col-xl-8">
            <div class="card border-0 bg-white">
                <div class="card-body">
                    <h6 class="mb-3">Distribución Mensual</h6>
                    <div class="d-flex gap-2 mb-4">
                        <button class="btn btn-sm px-3 bg-primary bg-opacity-10 text-primary">Semanal</button>
                        <button class="btn btn-sm px-3 btn-primary">Mensual</button>
                        <button class="btn btn-sm px-3 bg-primary bg-opacity-10 text-primary">Anual</button>
                    </div>
                    <div style="height: 250px;" class="chart-container">
                        <div class="d-flex align-items-end" style="height: 100%; gap: 2rem;">
                            @foreach(['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'] as $index => $mes)
                                <div class="d-flex flex-column align-items-center" style="flex: 1;">
                                    <div style="width: 100%; background-color: #0d6efd; border-radius: 4px 4px 0 0; height: {{ [60, 75, 55, 70, 50, 80][$index] }}%;"></div>
                                    <span class="text-muted small mt-2">{{ $mes }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="col-xl-4">
            <div class="card border-0 bg-white">
                <div class="card-body">
                    <h6 class="mb-3">Actividad Reciente</h6>
                    <div class="activity-list">
                        @foreach($recentActivity as $activity)
                            <div class="activity-item mb-3">
                                <div class="d-flex align-items-start">
                                    <div class="me-2">
                                        @if($activity['type'] === 'beneficiario')
                                            <span class="badge bg-success rounded-pill">Nuevo</span>
                                        @elseif($activity['type'] === 'inventario')
                                            <span class="badge bg-primary rounded-pill">Actualización</span>
                                        @elseif($activity['type'] === 'alerta')
                                            <span class="badge bg-warning rounded-pill">Alerta</span>
                                        @elseif($activity['type'] === 'eliminacion')
                                            <span class="badge bg-danger rounded-pill">Eliminación</span>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="mb-1">{{ $activity['message'] }}</p>
                                        <div class="d-flex align-items-center text-muted small">
                                            <span>Por {{ $activity['user'] }}</span>
                                            <span class="mx-1">•</span>
                                            <span>{{ Carbon\Carbon::parse($activity['date'])->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        box-shadow: 0 2px 4px rgba(0,0,0,.05);
        border-radius: 8px;
    }
    .activity-list {
        max-height: 300px;
        overflow-y: auto;
    }
    .badge {
        font-size: 11px;
        padding: 0.25em 0.75em;
    }
    h3 {
        font-size: 1.75rem;
        font-weight: 600;
    }
    h6 {
        font-weight: 600;
    }
    .rounded-circle {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .chart-container {
        position: relative;
    }
    .btn-sm {
        font-size: 0.875rem;
    }
</style>
@endsection
