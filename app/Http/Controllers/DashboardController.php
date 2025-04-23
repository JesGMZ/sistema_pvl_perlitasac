<?php

namespace App\Http\Controllers;

use App\Models\Beneficiario;
use App\Models\Comite;
use App\Models\Detallepvl;
use App\Models\Producto;
use App\Models\Pvl;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {

        $availableMonths = Pvl::select(
            DB::raw("DATE_FORMAT(fecha, '%Y-%m') as value"),
            DB::raw("DATE_FORMAT(fecha, '%M %Y') as label")
        )
        ->distinct()
        ->orderBy('value', 'desc')
        ->get()
        ->toArray();
    
        // Total de beneficiarios vigentes y crecimiento
        $totalBeneficiarios = Beneficiario::where('estado', 'Vigente')->count();
        // Simplificamos el cálculo para mostrar un crecimiento fijo por ahora
        $beneficiariosGrowth = 5.3;
    
        // Distribución mensual actual
        $now = Carbon::now();
        $currentMonthDetalles = Detallepvl::whereHas('pvl', fn($query) =>
            $query->whereMonth('fecha', $now->month)->whereYear('fecha', $now->year)
        )->get();
        $totalDistribucion = $currentMonthDetalles->sum('cantidad');
    
        // Distribución del mes anterior
        $lastMonth = $now->copy()->subMonth();
        $lastMonthDetalles = Detallepvl::whereHas('pvl', fn($query) =>
            $query->whereMonth('fecha', $lastMonth->month)->whereYear('fecha', $lastMonth->year)
        )->get();
        $lastMonthDistribucion = $lastMonthDetalles->sum('cantidad');
    
        $distribucionGrowth = $lastMonthDistribucion > 0
            ? (($totalDistribucion - $lastMonthDistribucion) / $lastMonthDistribucion) * 100
            : 2.1; // Valor por defecto para la demo
    
        // Comités activos
        $comitesActivos = Comite::count();
        // No hay cambio en comités
        $comitesGrowth = 0;
    
        // Alertas de stock bajo
        $stockBajo = Producto::where('cantidad', '<=', 30)->count();
        // Simulamos 2 alertas menos que el mes pasado
        $alertasGrowth = -2;
    
        // Actividad reciente
        $recentActivity = collect([
            [
                'type' => 'beneficiario',
                'message' => 'Registro nuevo beneficiario',
                'user' => 'María López',
                'date' => now()->subMinutes(10)
            ],
            [
                'type' => 'inventario',
                'message' => 'Actualización de inventario',
                'user' => 'Juan Pérez',
                'date' => now()->subMinutes(25)
            ],
            [
                'type' => 'alerta',
                'message' => 'Alerta: Stock bajo de leche',
                'user' => 'Sistema',
                'date' => now()->subHour()
            ],
            [
                'type' => 'eliminacion',
                'message' => 'Eliminación de registro duplicado',
                'user' => 'Admin',
                'date' => now()->subHours(2)
            ]
        ])->sortByDesc('date')->values();
    

            $distribucionPorProducto = Detallepvl::with(['producto', 'pvl'])
                ->whereHas('pvl', fn($query) => 
                    $query->whereMonth('fecha', $now->month)
                        ->whereYear('fecha', $now->year)
                )
                ->get()
                ->groupBy(fn($detalle) => $detalle->producto->nombre)
                ->map(fn($items) => $items->sum('cantidad'));

            $distribucionProductos = [
                'labels' => $distribucionPorProducto->keys()->all(),
                'data' => $distribucionPorProducto->values()->all()
            ];

        // Datos para el gráfico de entregas
        $entregasData = $this->getEntregasData();
        
        // Obtener todos los comités para el filtro
        $comites = Comite::all();
        
        // Obtener todos los PVLs ordenados por fecha
        $pvls = Pvl::orderBy('fecha', 'desc')->get();

        return view('dashboard.dashboard_main', compact(
            'totalBeneficiarios',
            'beneficiariosGrowth',
            'totalDistribucion',
            'distribucionGrowth',
            'comitesActivos',
            'comitesGrowth',
            'stockBajo',
            'alertasGrowth',
            'recentActivity',
            'availableMonths',
            'distribucionPorProducto',
            'entregasData',
            'comites',
            'pvls'
        ));
    }

    private function getEntregasData($comiteId = null, $pvlId = null)
    {
        $query = Detallepvl::query();
        
        if ($pvlId) {
            $query->where('idpvl', $pvlId);
        } else if ($comiteId) {
            $query->whereHas('pvl', function($q) use ($comiteId) {
                $q->where('idcomite', $comiteId);
            });
        }

        $entregas = $query->get()
            ->groupBy('cantidad')
            ->map(function($group) {
                return $group->count();
            })
            ->sortBy(function($count, $cantidad) {
                return $cantidad;
            });

        return [
            'labels' => $entregas->keys()->map(function($cantidad) {
                return $cantidad . ' lt';
            })->values()->all(),
            'values' => $entregas->values()->all()
        ];
    }

    public function getEntregasDataJson(Request $request)
    {
        return response()->json($this->getEntregasData(
            $request->idcomite,
            $request->idpvl
        ));
    }

    public function getPvlsPorComite(Request $request)
    {
        $pvls = Pvl::where('idcomite', $request->idcomite)
            ->orderBy('fecha')
            ->get()
            ->map(function($pvl) {
                return [
                    'id' => $pvl->idpvl,
                    'label' => $pvl->fecha->format('d/m/Y')
                ];
            });
        
        return response()->json($pvls);
    }

    public function generarReporte(Request $request)
    {
        $fecha = Carbon::createFromFormat('Y-m', $request->mes);
    
        // Obtener los detalles de los productos distribuidos en el mes y año especificado
        $detalles = Detallepvl::with(['pvl.comite.municipalidad', 'producto'])
            ->whereHas('pvl', fn($query) => 
                $query->whereMonth('fecha', $fecha->month)->whereYear('fecha', $fecha->year)
            )
            ->get();
    
        // Estructurar los datos para incluir los campos solicitados
        $datosReporte = $detalles->map(function($detalle) {
            return [
                'pvl_fecha' => Carbon::parse($detalle->pvl->fecha)->isoFormat('MMMM YYYY'), 
                'municipalidad_razonsocial' => $detalle->pvl->comite->municipalidad->razonsocial,  
                'comite_nombre' => $detalle->pvl->comite->nombre,  
                'producto_descripcion' => $detalle->producto->descripcion, 
                'producto_cantidad' => $detalle->producto->cantidad,  
                'detallepvl_cantidad' => $detalle->cantidad,  
                'detallepvl_precio' => $detalle->precio,
                'producto_unidadmedida' => $detalle->producto->unidadmedida,

            ];
        });
    
        $totalDistribuido = $detalles->sum('cantidad');
    
 
        $data = [
            'fecha' => $fecha->isoFormat('MMMM YYYY'),
            'total_distribuido' => $totalDistribuido,
            'datos_reporte' => $datosReporte
        ];
    
        $pdf = PDF::loadView('reportes.mensual', $data);

        return $pdf->download('reporte-' . $fecha->format('Y-m') . '.pdf');
    }
    
}
