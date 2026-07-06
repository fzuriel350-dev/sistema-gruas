<?php

namespace App\Http\Controllers;

use App\Models\BitacoraTiempoServicio;
use App\Models\Servicio;
use Illuminate\Http\Request;

class BitacoraTiempoServicioController extends Controller
{
    public function index()
    {
        $this->authorize('empleado');
        $bitacoras = BitacoraTiempoServicio::with('servicio.cotizacion.cliente')
            ->orderByDesc('id')
            ->paginate(15);
        return view('bitacora_tiempos.index', compact('bitacoras'));
    }

    public function create()
    {
        $this->authorize('empleado');
        $servicios = Servicio::where('empresa_id', session('empresa_id'))
            ->with('cotizacion.cliente')
            ->orderByDesc('id')
            ->get();
        return view('bitacora_tiempos.create', compact('servicios'));
    }

    public function store(Request $request)
    {
        $this->authorize('empleado');
        $data = $request->validate([
            'servicio_id' => 'required|exists:servicios,id',
            'hora_asignado' => 'nullable|date',
            'hora_inicio_servicio' => 'nullable|date',
            'hora_en_sitio_origen' => 'nullable|date',
            'hora_salida_destino' => 'nullable|date',
            'hora_en_destino' => 'nullable|date',
            'hora_finalizado' => 'nullable|date',
        ]);
        BitacoraTiempoServicio::create($data);
        return redirect()->route('bitacora-tiempos.index')->with('success', 'Bitácora de tiempos registrada.');
    }

    public function show(BitacoraTiempoServicio $bitacoraTiempo)
    {
        $this->authorize('empleado');
        $bitacoraTiempo->load('servicio.cotizacion.cliente', 'servicio.operador.empleado', 'servicio.unidad');
        return view('bitacora_tiempos.show', compact('bitacoraTiempo'));
    }

    public function edit(BitacoraTiempoServicio $bitacoraTiempo)
    {
        $this->authorize('empleado');
        $servicios = Servicio::where('empresa_id', session('empresa_id'))
            ->with('cotizacion.cliente')
            ->orderByDesc('id')
            ->get();
        return view('bitacora_tiempos.edit', compact('bitacoraTiempo', 'servicios'));
    }

    public function update(Request $request, BitacoraTiempoServicio $bitacoraTiempo)
    {
        $this->authorize('empleado');
        $data = $request->validate([
            'servicio_id' => 'required|exists:servicios,id',
            'hora_asignado' => 'nullable|date',
            'hora_inicio_servicio' => 'nullable|date',
            'hora_en_sitio_origen' => 'nullable|date',
            'hora_salida_destino' => 'nullable|date',
            'hora_en_destino' => 'nullable|date',
            'hora_finalizado' => 'nullable|date',
        ]);
        $bitacoraTiempo->update($data);
        return redirect()->route('bitacora-tiempos.index')->with('success', 'Bitácora de tiempos actualizada.');
    }

    public function destroy(BitacoraTiempoServicio $bitacoraTiempo)
    {
        $this->authorize('admin');
        $bitacoraTiempo->delete();
        return redirect()->route('bitacora-tiempos.index')->with('success', 'Bitácora de tiempos eliminada.');
    }
}
