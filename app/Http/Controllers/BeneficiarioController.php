<?php

namespace App\Http\Controllers;

use App\Models\Beneficiario;
use App\Models\Categoria;
use App\Models\Socio;
use Illuminate\Http\Request;

class BeneficiarioController extends Controller
{

    public function registro()
    {
        $categorias =  Categoria::where('estado', 'Vigente')->get();
        $socios =  Socio::all();

        return view('beneficiario.registro_beneficiario', compact('categorias', 'socios'));
    }

    public function mostrar()
    {
        $beneficiarios = Beneficiario::where('estado', 'Vigente')
            ->with(['categoria', 'socio'])
            ->get();
        return view('beneficiario.mostrar_beneficiario', compact('beneficiarios'));
    }

    // Guardar beneficiario
    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'parentesco' => 'required|string|max:100',
            'sexo' => 'required|string|in:Masculino,Femenino',
            'idcategoria' => 'required|exists:categoria,idcategoria',
            'idsocios' => 'required|exists:socios,idsocios',
            'fechanacimiento' => 'required|date',
            'edad' => 'nullable|string|max:10'
        ]);

        Beneficiario::create([
            'nombres'         => $request->nombres,
            'apellidos'       => $request->apellidos,
            'direccion'       => $request->direccion,
            'parentesco'      => $request->parentesco,
            'sexo'            => $request->sexo,
            'idcategoria'     => $request->idcategoria,
            'idsocios'        => $request->idsocios,
            'fechanacimiento' => $request->fechanacimiento,
            'edad'            => $request->edad,
            'estado'          => 'Vigente',
        ]);

        return redirect()->route('beneficiario.registro')->with('success', 'Beneficiario registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Beneficiario $beneficiario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $beneficiario = Beneficiario::findOrFail($id);
        $categorias = Categoria::where('estado', 'Vigente')->get();
        $socios =  Socio::all();
        return view('beneficiario.editar_beneficiario', compact('beneficiario', 'categorias', 'socios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'parentesco' => 'required|string|max:100',
            'sexo' => 'required|string|in:Masculino,Femenino',
            'idcategoria' => 'required|exists:categoria,idcategoria',
            'idsocios' => 'required|exists:socios,idsocios',
            'fechanacimiento' => 'required|date',
            'edad' => 'nullable|string|max:10'
        ]);

        $beneficiario = Beneficiario::findOrFail($id);
        $beneficiario->update($request->all());

        return redirect()->route('beneficiario.mostrar')->with('success', 'Beneficiario actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $beneficiario = Beneficiario::findOrFail($id);
        $beneficiario->estado = 'Inactivo';
        $beneficiario->save();

        return redirect()->route('beneficiario.mostrar')->with('success', 'Beneficiario eliminado correctamente');
    }
}
