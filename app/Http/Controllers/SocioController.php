<?php

namespace App\Http\Controllers;

use App\Models\Socio;
use Illuminate\Http\Request;

class SocioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    
    public function registro()
    {
        return view('socio.registro_socio');
    }

    public function mostrar()
    {
        $socios = Socio::all();
        return view('socio.mostrar_socio', compact('socios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'dni' => 'required|digits:8',
            'direccion' => 'nullable|string|max:255',
            'sexo' => 'required|in:Masculino,Femenino',
            'fechanacimiento' => 'required|date',
            'edad' => 'required|numeric|min:0',
        ]);

        Socio::create($request->all());

        return redirect()->back()->with('success', 'Socio registrado correctamente.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Socio $socio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Socio $socio)
    {
        return view('socio.editar_socio', compact('socio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Socio $socio)
    {
        $request->validate([
            'dni' => 'required|string|max:8',
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'sexo' => 'required|string|in:Masculino,Femenino',
            'fechanacimiento' => 'required|date',
            'edad' => 'nullable|string|max:10',
        ]);

        $socio->update($request->all());
        return redirect()->route('socio.mostrar')->with('success', 'Socio actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Socio $socio)
    {
        $socio->delete();
        return redirect()->route('socio.mostrar')->with('success', 'Socio eliminado correctamente');
    }
}
