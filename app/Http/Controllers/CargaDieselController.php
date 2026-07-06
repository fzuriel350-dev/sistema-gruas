<?php

namespace App\Http\Controllers;

use App\Models\CargaDiesel;
use App\Models\Unidad;
use App\Models\Operador;
use Illuminate\Http\Request;

class CargaDieselController extends Controller
{
    public function index()
    {
        $this->authorize('empleado');
        $cargas = CargaDiesel::where('empresa_id', session('empresa_id'))
            ->with('unidad', 'operador.empleado')
            ->orderByDesc('fecha_carga')
            ->paginate(15);
        return view('cargas_diesel.index', compact('cargas'));
    }

    public function create()
    {
        $this->authorize('admin');
        $unidades = Unidad::where('empresa_id', session('empresa_id'))->orderBy('marca')->get();
        $operadores = Operador::where('empresa_id', session('empresa_id'))
            ->with('empleado')
            ->orderBy('id')
            ->get();
        return view('cargas_diesel.create', compact('unidades', 'operadores'));
    }

    public function store(Request $request)
    {
        $this->authorize('admin');
        $data = $request->validate([
            'unidad_id' => 'required|exists:unidades,id',
            'operador_id' => 'required|exists:operadores,id',
            'litros' => 'required|numeric|min:0',
            'costo_litro' => 'required|numeric|min:0',
            'km_actual' => 'required|integer|min:0',
            'fecha_carga' => 'required|date',
            'observaciones' => 'nullable|string',
        ]);
        $data['importe_total'] = $data['litros'] * $data['costo_litro'];
        $data['empresa_id'] = session('empresa_id');
        CargaDiesel::create($data);
        return redirect()->route('cargas-diesel.index')->with('success', 'Carga de diesel registrada correctamente.');
    }

    public function show(CargaDiesel $cargaDiesel)
    {
        $this->authorize('empleado');
        $cargaDiesel->load('unidad', 'operador.empleado');
        return view('cargas_diesel.show', compact('cargaDiesel'));
    }

    public function edit(CargaDiesel $cargaDiesel)
    {
        $this->authorize('admin');
        $unidades = Unidad::where('empresa_id', session('empresa_id'))->orderBy('marca')->get();
        $operadores = Operador::where('empresa_id', session('empresa_id'))
            ->with('empleado')
            ->orderBy('id')
            ->get();
        return view('cargas_diesel.edit', compact('cargaDiesel', 'unidades', 'operadores'));
    }

    public function update(Request $request, CargaDiesel $cargaDiesel)
    {
        $this->authorize('admin');
        $data = $request->validate([
            'unidad_id' => 'required|exists:unidades,id',
            'operador_id' => 'required|exists:operadores,id',
            'litros' => 'required|numeric|min:0',
            'costo_litro' => 'required|numeric|min:0',
            'km_actual' => 'required|integer|min:0',
            'fecha_carga' => 'required|date',
            'observaciones' => 'nullable|string',
        ]);
        $data['importe_total'] = $data['litros'] * $data['costo_litro'];
        $cargaDiesel->update($data);
        return redirect()->route('cargas-diesel.index')->with('success', 'Carga de diesel actualizada correctamente.');
    }

    public function destroy(CargaDiesel $cargaDiesel)
    {
        $this->authorize('admin');
        $cargaDiesel->delete();
        return redirect()->route('cargas-diesel.index')->with('success', 'Carga de diesel eliminada.');
    }
}
