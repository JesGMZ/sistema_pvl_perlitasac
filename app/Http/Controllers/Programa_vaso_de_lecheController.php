<?php

namespace App\Http\Controllers;


use App\Models\Beneficiario;
use App\Models\Comite;
use App\Models\Producto;
use App\Models\Pvl;
use App\Models\Detallepvl;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Programa_vaso_de_lecheController extends Controller
{

    public function registro()
    {
        $beneficiarios = Beneficiario::all();
        $comites = Comite::all();
        $productos = Producto::all();
        
        return view('programa.registro_programa', compact('beneficiarios', 'comites', 'productos'));
    }

    public function mostrar()
    {
        $pvls = Pvl::with(['beneficiario', 'comite'])
                ->where('estado', 'Vigente')
                ->get();

        return view('programa.mostrar_programa', compact('pvls')); 
    }

    public function mostrarCompleto()
    {
        $pvls = Pvl::with(['beneficiario', 'comite'])
                ->where('estado', 'Vigente')
                ->get();

        $detalles = Detallepvl::with(['pvl', 'producto'])->get();

        return view('programa.programa_completo', compact('pvls', 'detalles'));
    }

    public function store(Request $request)
    {
        // Validar los datos básicos primero
        $validated = $request->validate([
            'fecha' => 'required|date',
            'idbeneficiarios' => 'required|exists:beneficiarios,idbeneficiarios',
            'idcomite' => 'required|exists:comite,idcomite',
            'mes' => 'required|string|max:20',
            'productos' => 'required|array|min:1',
        ]);

        // Validar cada producto individualmente
        foreach ($request->productos as $index => $producto) {
            $request->validate([
                "productos.$index.idproductos" => 'required|exists:productos,idproductos',
                "productos.$index.cantidad" => 'required|numeric|min:0.01',
                "productos.$index.precio" => 'required|numeric|min:0'
            ]);
        }

        // Crear el registro principal usando transacción para seguridad
        $pvl = DB::transaction(function () use ($request) {
            $pvl = Pvl::create([
                'fecha' => $request->fecha,
                'idbeneficiarios' => $request->idbeneficiarios,
                'idcomite' => $request->idcomite,
                'estado' => 'Vigente',
                'mes' => $request->mes,
            ]);

            // Crear los detalles
            $detalles = [];
            foreach ($request->productos as $detalle) {
                $detalles[] = [
                    'idpvl' => $pvl->idpvl,
                    'idproductos' => $detalle['idproductos'],
                    'cantidad' => $detalle['cantidad'],
                    'precio' => $detalle['precio']
                ];
            }

            // Insertar todos los detalles en una sola operación
            Detallepvl::insert($detalles);

            return $pvl;
        });

        return redirect()
            ->route('programa.registro')
            ->with('success', 'Registro PVL guardado exitosamente con '.count($request->productos).' productos.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Pvl $pvl)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pvl $pvl)
    {
        $beneficiarios = \App\Models\Beneficiario::where('estado', 'Vigente')->get();
        $comites = \App\Models\Comite::all();
        return view('programa.editar_programa', compact('pvl', 'beneficiarios', 'comites'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pvl $pvl)
    {
        $request->validate([
            'fecha' => 'required|date',
            'idbeneficiarios' => 'required|exists:beneficiarios,idbeneficiarios',
            'idcomite' => 'required|exists:comite,idcomite',
            'mes' => 'required|string|max:20',
            'productos' => 'required|array',
            'productos.*.idproductos' => 'required|exists:producto,idproducto',
            'productos.*.cantidad' => 'required|numeric|min:1',
            'productos.*.precio' => 'required|numeric|min:0'
        ]);

        // 1. Actualizar los datos principales de PVL
        $pvl->update([
            'fecha' => $request->fecha,
            'idbeneficiarios' => $request->idbeneficiarios,
            'idcomite' => $request->idcomite,
            'mes' => $request->mes
        ]);

        // 2. Eliminar los productos anteriores (detallepvl)
        $pvl->detallepvls()->delete();

        // 3. Registrar los nuevos productos
        foreach ($request->productos as $detalle) {
            Detallepvl::create([
                'idpvl' => $pvl->idpvl,
                'idproductos' => $detalle['idproductos'],
                'cantidad' => $detalle['cantidad'],
                'precio' => $detalle['precio'],
            ]);
        }

        return redirect()->route('programa.mostrar')->with('success', 'Registro PVL actualizado con sus productos.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pvl $pvl)
    {
        $pvl->estado = 'Inactivo';
        $pvl->save();
        return redirect()->route('programa.mostrar')->with('success', 'Registro PVL eliminado correctamente');
    }
}
