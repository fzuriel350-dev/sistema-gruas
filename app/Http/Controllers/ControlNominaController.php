<?php

namespace App\Http\Controllers;

use App\Models\ControlNomina;
use App\Models\Operador;
use Illuminate\Http\Request;

class ControlNominaController extends Controller
{
    public function index()
    {
        $this->authorize('empleado');
        $nominas = ControlNomina::where('empresa_id', session('empresa_id'))
            ->with('operador.empleado')
            ->orderByDesc('id')
            ->paginate(15);
        return view('control_nomina.index', compact('nominas'));
    }

    public function create()
    {
        $this->authorize('admin');
        $operadores = Operador::where('empresa_id', session('empresa_id'))
            ->with('empleado')
            ->orderBy('id')
            ->get();
        return view('control_nomina.create', compact('operadores'));
    }

    public function store(Request $request)
    {
        $this->authorize('admin');
        $data = $request->validate([
            'operador_id' => 'required|exists:operadores,id',
            'fecha_desde' => 'required|date',
            'fecha_hasta' => 'required|date|after_or_equal:fecha_desde',
            'sueldo_base_semanal' => 'required|numeric|min:0',
            'bonos_servicios' => 'nullable|numeric|min:0',
            'descuentos_prestamos' => 'nullable|numeric|min:0',
            'total_neto_a_pagar' => 'required|numeric|min:0',
            'estatus' => 'required|in:pendiente,pagado',
        ]);
        $data['empresa_id'] = session('empresa_id');
        $data['bonos_servicios'] ??= 0;
        $data['descuentos_prestamos'] ??= 0;
        ControlNomina::create($data);
        return redirect()->route('control-nomina.index')->with('success', 'Nómina registrada correctamente.');
    }

    public function show(ControlNomina $controlNomina)
    {
        $this->authorize('empleado');
        $controlNomina->load('operador.empleado');
        return view('control_nomina.show', compact('controlNomina'));
    }

    public function edit(ControlNomina $controlNomina)
    {
        $this->authorize('admin');
        $operadores = Operador::where('empresa_id', session('empresa_id'))
            ->with('empleado')
            ->orderBy('id')
            ->get();
        return view('control_nomina.edit', compact('controlNomina', 'operadores'));
    }

    public function update(Request $request, ControlNomina $controlNomina)
    {
        $this->authorize('admin');
        $data = $request->validate([
            'operador_id' => 'required|exists:operadores,id',
            'fecha_desde' => 'required|date',
            'fecha_hasta' => 'required|date|after_or_equal:fecha_desde',
            'sueldo_base_semanal' => 'required|numeric|min:0',
            'bonos_servicios' => 'nullable|numeric|min:0',
            'descuentos_prestamos' => 'nullable|numeric|min:0',
            'total_neto_a_pagar' => 'required|numeric|min:0',
            'estatus' => 'required|in:pendiente,pagado',
        ]);
        $data['bonos_servicios'] ??= 0;
        $data['descuentos_prestamos'] ??= 0;
        $controlNomina->update($data);
        return redirect()->route('control-nomina.index')->with('success', 'Nómina actualizada correctamente.');
    }

    public function destroy(ControlNomina $controlNomina)
    {
        $this->authorize('admin');
        $controlNomina->delete();
        return redirect()->route('control-nomina.index')->with('success', 'Nómina eliminada.');
    }
}
