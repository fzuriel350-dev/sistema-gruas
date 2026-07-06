<?php

namespace App\Http\Controllers;

use App\Models\Cotizacion;
use App\Models\Convenio;
use App\Models\Cliente;
use App\Models\Aseguradora;
use App\Models\TipoServicio;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CotizacionController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $empresaId = session('empresa_id');

        $query = Cotizacion::where('empresa_id', $empresaId)
            ->with('cliente', 'aseguradora', 'tipoServicio');

        if ($user->isCliente()) {
            $query->where('usuario_creador_id', $user->id);
        }

        if (request('aseguradora_id')) {
            $query->where('aseguradora_id', request('aseguradora_id'));
        }

        if (request('estatus')) {
            $query->where('estatus', request('estatus'));
        }

        if ($q = request('q')) {
            $query->where(function ($qry) use ($q) {
                $qry->where('folio', 'like', "%{$q}%")
                    ->orWhere('origen_direccion', 'like', "%{$q}%")
                    ->orWhere('destino_direccion', 'like', "%{$q}%")
                    ->orWhereHas('cliente', fn($c) => $c->where('nombre', 'like', "%{$q}%"));
            });
        }

        $cotizaciones = $query->orderBy('created_at', 'desc')->paginate(15);

        $aseguradoras = Aseguradora::where('empresa_id', $empresaId)->orderBy('nombre')->get();

        return view('cotizaciones.index', compact('cotizaciones', 'aseguradoras'));
    }

    public function create()
    {
        $empresaId = session('empresa_id');
        $clientes = Cliente::where('empresa_id', $empresaId)->orderBy('nombre')->get();
        $aseguradoras = Aseguradora::where('empresa_id', $empresaId)->orderBy('nombre')->get();
        $tiposServicio = TipoServicio::where('empresa_id', $empresaId)->orderBy('nombre')->get();
        $convenios = Convenio::where('empresa_id', $empresaId)->get();

        return view('cotizaciones.create', compact('clientes', 'aseguradoras', 'tiposServicio', 'convenios'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'cliente_id' => 'nullable|exists:clientes,id',
            'aseguradora_id' => 'required|exists:aseguradoras,id',
            'tipo_servicio_id' => 'required|exists:tipos_servicio,id',
            'origen_direccion' => 'required|string',
            'origen_lat' => 'nullable|numeric|between:-90,90',
            'origen_lng' => 'nullable|numeric|between:-180,180',
            'destino_direccion' => 'required|string',
            'destino_lat' => 'nullable|numeric|between:-90,90',
            'destino_lng' => 'nullable|numeric|between:-180,180',
            'distancia_km' => 'required|numeric|min:0',
            'tiempo_estimado_minutos' => 'required|integer|min:0',
            'incluye_peajes' => 'boolean',
            'costo_aprox_casetas' => 'numeric|min:0',
            'costo_banderazo' => 'required|numeric|min:0',
            'costo_km' => 'required|numeric|min:0',
            'convenio_aplicado_id' => 'nullable|exists:convenios,id',
        ]);

        $data['empresa_id'] = session('empresa_id');
        $data['incluye_peajes'] = $request->boolean('incluye_peajes');
        $data['costo_aprox_casetas'] = $request->input('costo_aprox_casetas', 0);
        $data['usuario_creador_id'] = auth()->id();
        $data['folio'] = $this->generarFolio();
        $data['km_excedente'] = 0;

        $cotizacion = new Cotizacion($data);
        $cotizacion = $this->calcularCostos($cotizacion);
        $cotizacion->estatus = 'pendiente';

        $cotizacion->save();

        return redirect()->route('cotizaciones.index')
            ->with('success', 'Cotización generada correctamente.');
    }

    public function show(Cotizacion $cotizacione)
    {
        $cotizacione->load('cliente', 'aseguradora', 'tipoServicio', 'creador', 'convenio');
        return view('cotizaciones.show', compact('cotizacione'));
    }

    public function edit(Cotizacion $cotizacione)
    {
        $empresaId = session('empresa_id');
        $clientes = Cliente::where('empresa_id', $empresaId)->orderBy('nombre')->get();
        $aseguradoras = Aseguradora::where('empresa_id', $empresaId)->orderBy('nombre')->get();
        $tiposServicio = TipoServicio::where('empresa_id', $empresaId)->orderBy('nombre')->get();
        $convenios = Convenio::where('empresa_id', $empresaId)->get();

        return view('cotizaciones.edit', compact('cotizacione', 'clientes', 'aseguradoras', 'tiposServicio', 'convenios'));
    }

    public function update(Request $request, Cotizacion $cotizacione)
    {
        $data = $request->validate([
            'cliente_id' => 'nullable|exists:clientes,id',
            'aseguradora_id' => 'required|exists:aseguradoras,id',
            'tipo_servicio_id' => 'required|exists:tipos_servicio,id',
            'origen_direccion' => 'required|string',
            'origen_lat' => 'nullable|numeric|between:-90,90',
            'origen_lng' => 'nullable|numeric|between:-180,180',
            'destino_direccion' => 'required|string',
            'destino_lat' => 'nullable|numeric|between:-90,90',
            'destino_lng' => 'nullable|numeric|between:-180,180',
            'distancia_km' => 'required|numeric|min:0',
            'tiempo_estimado_minutos' => 'required|integer|min:0',
            'incluye_peajes' => 'boolean',
            'costo_aprox_casetas' => 'numeric|min:0',
            'costo_banderazo' => 'required|numeric|min:0',
            'costo_km' => 'required|numeric|min:0',
            'convenio_aplicado_id' => 'nullable|exists:convenios,id',
        ]);

        $cotizacione->fill($data);
        $cotizacione->incluye_peajes = $request->boolean('incluye_peajes');
        $cotizacione = $this->calcularCostos($cotizacione);
        $cotizacione->save();

        return redirect()->route('cotizaciones.index')
            ->with('success', 'Cotización actualizada correctamente.');
    }

    public function destroy(Cotizacion $cotizacione)
    {
        $cotizacione->delete();
        return redirect()->route('cotizaciones.index')
            ->with('success', 'Cotización eliminada.');
    }

    private function calcularCostos(Cotizacion $cotizacion): Cotizacion
    {
        $costoKilometraje = $cotizacion->distancia_km * $cotizacion->costo_km;
        $cotizacion->costo_total = $cotizacion->costo_banderazo
            + $costoKilometraje
            + $cotizacion->costo_aprox_casetas;

        return $cotizacion;
    }

    private function generarFolio(): string
    {
        do {
            $folio = 'COT-' . strtoupper(Str::random(6));
        } while (Cotizacion::where('folio', $folio)->exists());

        return $folio;
    }
}
