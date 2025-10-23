<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Pasantia;
use App\Models\Docente;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function index(Request $request)
{
    $roles = Role::all();

    $query = User::with('role', 'pasantia', 'docente');

    if ($request->filled('role_id')) {
        $query->where('role_id', $request->role_id);
    }

    $usuarios = $query->get();

    return view('usuarios.index', compact('usuarios', 'roles'));
}


    public function create()
    {
        $roles = Role::all();
        return view('usuarios.create', compact('roles'));
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
            'carrera' => 'nullable|string|max:50',
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

        // ===========================
        // Crear pasantía si es pasante
        // ===========================
        if ($request->role_id == 3) {
            Pasantia::create([
                'idUser' => $user->id,
                'fechaInicio' => $request->fechaInicio,
                'fechaFinal' => $request->fechaFinal,
                'horaIngreso' => $request->horaIngreso,
            ]);
        }

        // ===========================
        // Crear docente si es docente
        // ===========================
        if ($request->role_id == 1) {
            Docente::create([
                'idUser' => $user->id,
                'carrera' => $request->carrera,
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
            'carrera' => 'nullable|string|max:50',
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

        // =================================
        // Actualizar o eliminar pasantía
        // =================================
        if ($request->role_id == 3) {
            $pasantia = $usuario->pasantia ?? new Pasantia();
            $pasantia->idUser = $usuario->id;
            $pasantia->fechaInicio = $request->fechaInicio;
            $pasantia->fechaFinal = $request->fechaFinal;
            $pasantia->horaIngreso = $request->horaIngreso;
            $pasantia->save();
        } else {
            if ($usuario->pasantia) {
                $usuario->pasantia->delete();
            }
        }

        // =================================
        // Actualizar o eliminar docente
        // =================================
        if ($request->role_id == 1) {
            $docente = $usuario->docente ?? new Docente();
            $docente->idUser = $usuario->id;
            $docente->carrera = $request->carrera;
            $docente->save();
        } else {
            if ($usuario->docente) {
                $usuario->docente->delete();
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

        // Eliminar docente si existe
        if ($usuario->docente) {
            $usuario->docente->delete();
        }

        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
