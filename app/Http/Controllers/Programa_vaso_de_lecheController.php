<?php

namespace App\Http\Controllers;

use App\Models\Pvl;
use Illuminate\Http\Request;

class Programa_vaso_de_lecheController extends Controller
{

    public function registro()
    {
        $beneficiarios = \App\Models\Beneficiario::all();
        $comites = \App\Models\Comite::all();
        return view('pvl.registro_pvl', compact('beneficiarios', 'comites'));
    }

    public function mostrar()
    {
        $programas = Pvl::where('estado', 'Vigente')
            ->with(['municipalidad', 'comite'])
            ->get();
        return view('pvl.mostrar_pvl', compact('programas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'idbeneficiarios' => 'required|exists:beneficiarios,idbeneficiarios',
            'idcomite' => 'required|exists:comite,idcomite',
            'mes' => 'required|string|max:20'
        ]);

        Pvl::create([
            'fecha' => $request->fecha,
            'idbeneficiarios' => $request->idbeneficiarios,
            'idcomite' => $request->idcomite,
            'estado' => 'Vigente',
            'mes' => $request->mes,
        ]);

        return redirect()->route('pvl.registro')->with('success', 'Registro PVL guardado correctamente.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pvl $pvl)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pvl $pvl)
    {
        //
    }
}
