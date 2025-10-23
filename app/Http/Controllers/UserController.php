<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Pasantia;
use Illuminate\Http\Request;

class UserController extends Controller
{
 public function index(Request $request)
{
    $query = User::with('role', 'pasantia');

    if ($request->filled('role_id')) {
        $query->where('role_id', $request->role_id);
    }

    $usuarios = $query->get();

    return view('usuarios.index', compact('usuarios'));
}



    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombreUsuario' => 'required|unique:users,nombreUsuario',
            'clave' => 'required|min:6',
            'role_id' => 'required|exists:roles,id',
            'nombre' => 'required',
            'paterno' => 'required',
            'materno' => 'nullable',
            'ci' => 'required|unique:users,ci',
            'fechaInicio' => 'nullable|date',
            'fechaFinal' => 'nullable|date',
            'horaIngreso' => 'nullable',
        ]);

        $user = User::create([
            'nombreUsuario' => $request->nombreUsuario,
            'clave' => bcrypt($request->clave),
            'role_id' => $request->role_id,
            'nombre' => $request->nombre,
            'paterno' => $request->paterno,
            'materno' => $request->materno,
            'ci' => $request->ci,
        ]);

        // Crear pasantía si es pasante
        if ($request->role_id == 3) {
            Pasantia::create([
                'idUser' => $user->id,
                'fechaInicio' => $request->fechaInicio,
                'fechaFinal' => $request->fechaFinal,
                'horaIngreso' => $request->horaIngreso,
            ]);
        }

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    public function edit(User $usuario)
    {
        $roles = Role::all();
        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'nombreUsuario' => 'required|unique:users,nombreUsuario,' . $usuario->id,
            'clave' => 'nullable|min:6',
            'role_id' => 'required|exists:roles,id',
            'nombre' => 'required',
            'paterno' => 'required',
            'materno' => 'nullable',
            'ci' => 'required|unique:users,ci,' . $usuario->id,
            'fechaInicio' => 'nullable|date',
            'fechaFinal' => 'nullable|date',
            'horaIngreso' => 'nullable',
        ]);

        $usuario->nombreUsuario = $request->nombreUsuario;

        if ($request->filled('clave')) {
            $usuario->clave = bcrypt($request->clave);
        }

        $usuario->role_id = $request->role_id;
        $usuario->nombre = $request->nombre;
        $usuario->paterno = $request->paterno;
        $usuario->materno = $request->materno;
        $usuario->ci = $request->ci;
        $usuario->save();

        // Crear o actualizar pasantía si es pasante
        if ($request->role_id == 3) {
            $pasantia = $usuario->pasantia ?? new Pasantia();
            $pasantia->idUser = $usuario->id;
            $pasantia->fechaInicio = $request->fechaInicio;
            $pasantia->fechaFinal = $request->fechaFinal;
            $pasantia->horaIngreso = $request->horaIngreso;
            $pasantia->save();
        } else {
            // Eliminar pasantía si el rol ya no es pasante
            if ($usuario->pasantia) {
                $usuario->pasantia->delete();
            }
        }

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $usuario)
    {
        // Eliminar pasantía si existe
        if ($usuario->pasantia) {
            $usuario->pasantia->delete();
        }

        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
