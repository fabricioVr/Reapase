<?php

namespace App\Http\Controllers;

use App\Models\Pasantia;
use App\Models\User;
use Illuminate\Http\Request;

class PasantiasController extends Controller
{
    // Mostrar todas las pasantías
    public function index()
    {
        $pasantias = Pasantia::with('usuario')->get();
        return view('usuarios.pasantias.index', compact('pasantias'));
    }

    // Formulario para crear nueva pasantía
    public function create()
    {
        // Solo usuarios con role_id = 3 (Pasante)
        $usuarios = User::where('role_id', 3)->get();
        return view('usuarios.create', compact('usuarios'));
    }

    // Guardar nueva pasantía
    public function store(Request $request)
    {
        $request->validate([
            'idUser' => 'required|exists:users,id',
            'fechaInicio' => 'required|date',
            'fechaFinal' => 'nullable|date|after_or_equal:fechaInicio',
            'horaIngreso' => 'nullable|date_format:H:i',
        ]);

        Pasantia::create($request->all());

        return redirect()->route('pasantias.index')->with('success', 'Pasantía creada correctamente.');
    }

    // Formulario para editar pasantía
    public function edit(Pasantia $pasantia)
    {
        $usuarios = User::where('role_id', 3)->get();
        return view('usuarios.edit', compact('pasantia', 'usuarios'));
    }

    // Actualizar pasantía
    public function update(Request $request, Pasantia $pasantia)
    {
        $request->validate([
            'idUser' => 'required|exists:users,id',
            'fechaInicio' => 'required|date',
            'fechaFinal' => 'nullable|date|after_or_equal:fechaInicio',
            'horaIngreso' => 'nullable|date_format:H:i',
        ]);

        $pasantia->update($request->all());

        return redirect()->route('pasantias.index')->with('success', 'Pasantía actualizada correctamente.');
    }

    // Eliminar pasantía
    public function destroy(Pasantia $pasantia)
    {
        $pasantia->delete();
        return redirect()->route('pasantias.index')->with('success', 'Pasantía eliminada correctamente.');
    }
}
