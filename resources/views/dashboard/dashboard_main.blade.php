@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0">Dashboard</h1>
                <!-- Selector para reportes -->
                <div class="input-group" style="width: auto;">
                    <select class="form-select" id="mesSelect">
                        <option value="">Mes</option>
                        @foreach($availableMonths as $month)
                            <option value="{{ $month['value'] }}">{{ $month['label'] }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-primary" onclick="generarReporte()">Generar Reporte</button>
                </div>

                <script>
                    function generarReporte() {
                        const mes = document.getElementById('mesSelect').value;
                        if (mes) {
                            window.location.href = `/dashboard/reporte/${mes}`;
                        } else {
                            alert('Por favor, selecciona un mes.');
                        }
                    }
                </script>

            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        @php
            $stats = [
                [
                    'label' => 'Total Beneficiarios',
                    'value' => $totalBeneficiarios,
                    'icon' => 'users',
                    'color' => 'primary',
                    'growth' => $beneficiariosGrowth
                ],
                [
                    'label' => 'Distribución Mensual',
                    'value' => number_format($totalDistribucion, 1) . ' kg',
                    'icon' => 'box',
                    'color' => 'success',
                    'growth' => $distribucionGrowth
                ],
                [
                    'label' => 'Comités Activos',
                    'value' => $comitesActivos,
                    'icon' => 'home',
                    'color' => 'info',
                    'growth' => $comitesGrowth
                ],
                [
                    'label' => 'Alertas Stock Bajo',
                    'value' => $stockBajo,
                    'icon' => 'exclamation-triangle',
                    'color' => 'warning',
                    'growth' => $alertasGrowth
                ],
            ];
        @endphp

        @foreach($stats as $stat)
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-muted small">{{ $stat['label'] }}</div>
                                <h3 class="mb-0">{{ $stat['value'] }}</h3>
                            </div>
                            <div class="rounded-circle bg-{{ $stat['color'] }} bg-opacity-10 p-3">
                                <i class="fas fa-{{ $stat['icon'] }} text-{{ $stat['color'] }}"></i>
                            </div>
                        </div>
                        @if($stat['growth'] > 0)
                            <div class="small mt-2 text-success">
                                <i class="fas fa-arrow-up"></i> {{ number_format($stat['growth'], 1) }}% desde el mes pasado
                            </div>
                        @elseif($stat['growth'] < 0)
                            <div class="small mt-2 text-danger">
                                <i class="fas fa-arrow-down"></i> {{ number_format(abs($stat['growth']), 1) }}% desde el mes pasado
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row g-4">
        <!-- Distribution Chart -->
        <div class="col-12 col-xl-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="card-title mb-0">Distribución</h5>
                        <div class="btn-group">
                            <button class="btn btn-outline-secondary btn-sm active" onclick="cambiarVista('distribucion')">Por Comité</button>
                            <button class="btn btn-outline-secondary btn-sm" onclick="cambiarVista('tendencia')">Tendencia</button>
                        </div>
                    </div>
                    <div class="chart-container">
                        <canvas id="distribucionChart"></canvas>
                        <canvas id="tendenciaChart" style="display: none;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="col-12 col-xl-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title mb-4">Actividad Reciente</h5>
                    <div class="activity-list">
                        @foreach($recentActivity as $activity)
                            <div class="d-flex align-items-start mb-3">
                                <div class="activity-icon rounded-circle bg-light-{{ $activity['type'] === 'beneficiario' ? 'primary' : 'success' }} me-3">
                                    <i class="fas fa-{{ $activity['type'] === 'beneficiario' ? 'user' : 'box' }} text-{{ $activity['type'] === 'beneficiario' ? 'primary' : 'success' }}"></i>
                                </div>
                                <div>
                                    <p class="mb-0">{{ $activity['message'] }}</p>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($activity['date'])->diffForHumans() }}</small>
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
    .activity-icon {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .bg-light-primary { background-color: rgba(13, 110, 253, 0.1); }
    .bg-light-success { background-color: rgba(25, 135, 84, 0.1); }
    .input-group { max-width: 300px; }
    .card:hover { transform: translateY(-3px); transition: transform 0.2s ease-in-out; }
    .chart-container { position: relative; height: 350px; }
    .btn-group .btn.active {
        background-color: #0d6efd;
        color: #fff;
        border-color: #0d6efd;
    }
    .activity-list {
        max-height: 400px;
        overflow-y: auto;
    }
    .activity-list::-webkit-scrollbar {
        width: 6px;
    }
    .activity-list::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 3px;
    }
    .activity-list::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>
@endsection