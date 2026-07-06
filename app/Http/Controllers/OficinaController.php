<?php

namespace App\Http\Controllers;

use App\Models\Oficina;
use Illuminate\Http\Request;

class OficinaController extends Controller
{
    public function index()
    {
        $this->authorize('empleado');
        $oficinas = Oficina::where('empresa_id', session('empresa_id'))
            ->orderBy('nombre')
            ->paginate(15);
        return view('oficinas.index', compact('oficinas'));
    }

    public function create()
    {
        $this->authorize('admin');
        return view('oficinas.create');
    }

    public function store(Request $request)
    {
        $this->authorize('admin');
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'nullable|string',
            'ciudad' => 'nullable|string|max:60',
            'estado' => 'nullable|string|max:45',
            'telefono' => 'nullable|string|max:25',
            'encargado' => 'nullable|string|max:150',
        ]);
        $data['empresa_id'] = session('empresa_id');
        Oficina::create($data);
        return redirect()->route('oficinas.index')->with('success', 'Oficina registrada correctamente.');
    }

    public function show(Oficina $oficina)
    {
        $this->authorize('empleado');
        return view('oficinas.show', compact('oficina'));
    }

    public function edit(Oficina $oficina)
    {
        $this->authorize('admin');
        return view('oficinas.edit', compact('oficina'));
    }

    public function update(Request $request, Oficina $oficina)
    {
        $this->authorize('admin');
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'nullable|string',
            'ciudad' => 'nullable|string|max:60',
            'estado' => 'nullable|string|max:45',
            'telefono' => 'nullable|string|max:25',
            'encargado' => 'nullable|string|max:150',
        ]);
        $oficina->update($data);
        return redirect()->route('oficinas.index')->with('success', 'Oficina actualizada correctamente.');
    }

    public function destroy(Oficina $oficina)
    {
        $this->authorize('admin');
        $oficina->delete();
        return redirect()->route('oficinas.index')->with('success', 'Oficina eliminada.');
    }
}
