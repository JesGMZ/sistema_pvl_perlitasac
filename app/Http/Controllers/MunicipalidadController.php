<?php

namespace App\Http\Controllers;

use App\Models\Municipalidad;
use Illuminate\Http\Request;

class MunicipalidadController extends Controller
{
    
    public function registro()
    {
        return view('municipalidad.registro_municipalidad');
    }

    public function mostrar()
    {
        $municipalidades = Municipalidad::where('estado', 'Vigente')->get();
        return view('municipalidad.mostrar_municipalidad', compact('municipalidades'));
    }

    // Guardar la municipalidad
    public function store(Request $request)
    {
        $request->validate([
            'razonsocial' => 'required',
            'ruc' => 'required|digits:11',
            'direccion' => 'required',
            'representante' => 'required'
        ]);

        Municipalidad::create([
            'razonsocial' => $request->razonsocial,
            'ruc' => $request->ruc,
            'direccion' => $request->direccion,
            'representante' => $request->representante,
            'estado' => 'Vigente',
        ]);

        return redirect()->back()->with('success', 'Municipalidad registrada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Municipalidad $municipalidad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $municipalidad = Municipalidad::findOrFail($id);
        return view('municipalidad.editar_municipalidad', compact('municipalidad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'razonsocial' => 'required',
            'ruc' => 'required|digits:11',
            'direccion' => 'required',
            'representante' => 'required'
        ]);

        $municipalidad = Municipalidad::findOrFail($id);
        $municipalidad->update($request->all());

        return redirect()->route('municipalidad.mostrar')->with('success', 'Municipalidad actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $municipalidad = Municipalidad::findOrFail($id);
        $municipalidad->estado = 'Inactivo';
        $municipalidad->save();

        return redirect()->route('municipalidad.mostrar')->with('success', 'Municipalidad eliminada correctamente');
    }
}
