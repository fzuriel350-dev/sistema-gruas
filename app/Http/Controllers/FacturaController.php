<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Cliente;
use App\Models\Servicio;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    public function index()
    {
        $this->authorize('empleado');
        $facturas = Factura::where('empresa_id', session('empresa_id'))
            ->with('cliente', 'servicio.cotizacion')
            ->orderByDesc('id')
            ->paginate(15);
        return view('facturas.index', compact('facturas'));
    }

    public function create()
    {
        $this->authorize('admin');
        $clientes = Cliente::where('empresa_id', session('empresa_id'))->orderBy('nombre')->get();
        $servicios = Servicio::where('empresa_id', session('empresa_id'))
            ->with('cotizacion')
            ->orderByDesc('id')
            ->get();
        return view('facturas.create', compact('clientes', 'servicios'));
    }

    public function store(Request $request)
    {
        $this->authorize('admin');
        $data = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'servicio_id' => 'required|exists:servicios,id',
            'folio_factura' => 'required|string|max:50',
            'subtotal' => 'required|numeric|min:0',
            'iva' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'uuid_fiscal' => 'nullable|string|max:100',
            'xml_url' => 'nullable|string|max:255',
            'pdf_url' => 'nullable|string|max:255',
            'estatus' => 'required|in:vigente,cancelada',
        ]);
        $data['empresa_id'] = session('empresa_id');
        Factura::create($data);
        return redirect()->route('facturas.index')->with('success', 'Factura registrada correctamente.');
    }

    public function show(Factura $factura)
    {
        $this->authorize('empleado');
        $factura->load('cliente', 'servicio.cotizacion.cliente', 'servicio.operador.empleado');
        return view('facturas.show', compact('factura'));
    }

    public function edit(Factura $factura)
    {
        $this->authorize('admin');
        $clientes = Cliente::where('empresa_id', session('empresa_id'))->orderBy('nombre')->get();
        $servicios = Servicio::where('empresa_id', session('empresa_id'))
            ->with('cotizacion')
            ->orderByDesc('id')
            ->get();
        return view('facturas.edit', compact('factura', 'clientes', 'servicios'));
    }

    public function update(Request $request, Factura $factura)
    {
        $this->authorize('admin');
        $data = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'servicio_id' => 'required|exists:servicios,id',
            'folio_factura' => 'required|string|max:50',
            'subtotal' => 'required|numeric|min:0',
            'iva' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'uuid_fiscal' => 'nullable|string|max:100',
            'xml_url' => 'nullable|string|max:255',
            'pdf_url' => 'nullable|string|max:255',
            'estatus' => 'required|in:vigente,cancelada',
        ]);
        $factura->update($data);
        return redirect()->route('facturas.index')->with('success', 'Factura actualizada correctamente.');
    }

    public function destroy(Factura $factura)
    {
        $this->authorize('admin');
        $factura->delete();
        return redirect()->route('facturas.index')->with('success', 'Factura eliminada.');
    }
}
