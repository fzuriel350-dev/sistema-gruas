@extends('layouts.app')@section('title', 'Nómina #' . $controlNomina->id)@section('content')<div class="max-w-3xl mx-auto">
<div class="flex items-center justify-between mb-6">
<div>
<h2 class="text-2xl font-extrabold tracking-tight">Nómina #{{ $controlNomina->id }}</h2>
<p class="text-sm text-gray-500">
<span class="px-2.5 py-1 rounded-full text-xs font-semibold
@if($controlNomina->estatus === 'pagado') bg-emerald-100 text-emerald-800
@else bg-amber-100 text-amber-800 @endif">
{{ ucfirst($controlNomina->estatus) }}
</span>
</p>
</div>
<a href="{{ route('control-nomina.index') }}" class="btn btn-secondary">← Volver</a>
</div>
<div class="card">
<div class="card-header"><h3>Detalle de nómina</h3></div>
<div class="card-body">
<div class="grid grid-cols-2 gap-4 text-sm">
<div>
<span class="text-gray-500">Operador</span>
<p class="font-semibold mt-0.5">{{ $controlNomina->operador?->empleado?->nombre ?? '—' }}</p>
</div>
<div>
<span class="text-gray-500">Período</span>
<p class="font-semibold mt-0.5">{{ $controlNomina->fecha_desde->format('d/m/Y') }} — {{ $controlNomina->fecha_hasta->format('d/m/Y') }}</p>
</div>
<div>
<span class="text-gray-500">Sueldo Base Semanal</span>
<p class="font-semibold mt-0.5">${{ number_format($controlNomina->sueldo_base_semanal, 2) }}</p>
</div>
<div>
<span class="text-gray-500">Bonos por Servicios</span>
<p class="font-semibold mt-0.5">${{ number_format($controlNomina->bonos_servicios, 2) }}</p>
</div>
<div>
<span class="text-gray-500">Descuentos / Préstamos</span>
<p class="font-semibold mt-0.5">${{ number_format($controlNomina->descuentos_prestamos, 2) }}</p>
</div>
<div>
<span class="text-gray-500">Total Neto a Pagar</span>
<p class="font-semibold mt-0.5 text-lg">${{ number_format($controlNomina->total_neto_a_pagar, 2) }}</p>
</div>
<div>
<span class="text-gray-500">Registrado</span>
<p class="font-semibold mt-0.5">{{ $controlNomina->created_at->format('d/m/Y H:i') }}</p>
</div>
</div>
</div>
</div>
@can('admin')<div class="flex items-center gap-3 mt-5">
<a href="{{ route('control-nomina.edit', $controlNomina) }}" class="btn btn-primary">Editar</a>
<form method="POST" action="{{ route('control-nomina.destroy', $controlNomina) }}" data-confirm="¿Eliminar esta nómina?">@csrf @method('DELETE')<button type="submit" class="btn btn-secondary">Eliminar</button></form>
</div>@endcan
</div>@endsection
