<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $usuarios = User::with('role')->get();
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
        ]);

        User::create([
            'nombreUsuario' => $request->nombreUsuario,
            'clave' => bcrypt($request->clave),
            'role_id' => $request->role_id,
            'nombre' => $request->nombre,
            'paterno' => $request->paterno,
            'materno' => $request->materno,
            'ci' => $request->ci,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

  public function edit(User $usuario)
    {
        $roles = Role::all();  // Traemos todos los roles
        return view('usuarios.edit', compact('usuario', 'roles'));
    }


    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'nombreUsuario' => 'required|unique:users,nombreUsuario,'.$usuario->id,
            'clave' => 'nullable|min:6',
            'role_id' => 'required|exists:roles,id',
            'nombre' => 'required',
            'paterno' => 'required',
            'materno' => 'nullable',
            'ci' => 'required|unique:users,ci,'.$usuario->id,
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

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $usuario)
    {
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
