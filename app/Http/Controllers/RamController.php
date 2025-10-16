<?php

namespace App\Http\Controllers;

use App\Models\Ram;
use Illuminate\Http\Request;

class RamController extends Controller
{
    public function index()
    {
        $rams = Ram::all();
        return view('ram.index', compact('rams'));
    }

    public function create()
    {
        return view('ram.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'capacidad' => 'required|string|max:20',
            'serie' => 'nullable|string|max:30',
        ]);

        Ram::create($request->all());

        return redirect()->route('ram.index')->with('success', 'RAM creada correctamente.');
    }

    public function edit(Ram $ram)
    {
        return view('ram.edit', compact('ram'));
    }

    public function update(Request $request, Ram $ram)
    {
        $request->validate([
            'capacidad' => 'required|string|max:20',
            'serie' => 'nullable|string|max:30',
        ]);

        $ram->update($request->all());

        return redirect()->route('ram.index')->with('success', 'RAM actualizada correctamente.');
    }

    public function destroy(Ram $ram)
    {
        $ram->delete();
        return redirect()->route('ram.index')->with('success', 'RAM eliminada correctamente.');
    }
}
