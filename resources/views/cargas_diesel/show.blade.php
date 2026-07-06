@extends('layouts.app')@section('title', 'Carga de Diesel')@section('content')<div class="max-w-3xl mx-auto">
<div class="flex items-center justify-between mb-6">
<div>
<h2 class="text-2xl font-extrabold tracking-tight">Carga de Diesel</h2>
<p class="text-sm text-gray-500">{{ $cargaDiesel->fecha_carga?->format('d/m/Y H:i') }}</p>
</div>
<a href="{{ route('cargas-diesel.index') }}" class="btn btn-secondary">← Volver</a>
</div>
<div class="card">
<div class="card-header"><h3>Detalles de la carga</h3></div>
<div class="card-body">
<div class="grid grid-cols-2 gap-4 text-sm">
<div>
<span class="text-gray-500">ID</span>
<p class="font-semibold mt-0.5">{{ $cargaDiesel->id }}</p>
</div>
<div>
<span class="text-gray-500">Unidad</span>
<p class="font-semibold mt-0.5">{{ $cargaDiesel->unidad?->marca }} {{ $cargaDiesel->unidad?->placas }}</p>
</div>
<div>
<span class="text-gray-500">Operador</span>
<p class="font-semibold mt-0.5">{{ $cargaDiesel->operador?->empleado?->nombreCompleto() ?: '—' }}</p>
</div>
<div>
<span class="text-gray-500">Litros</span>
<p class="font-semibold mt-0.5">{{ number_format($cargaDiesel->litros, 2) }} L</p>
</div>
<div>
<span class="text-gray-500">Costo por Litro</span>
<p class="font-semibold mt-0.5">${{ number_format($cargaDiesel->costo_litro, 2) }}</p>
</div>
<div>
<span class="text-gray-500">Importe Total</span>
<p class="font-semibold mt-0.5">${{ number_format($cargaDiesel->importe_total, 2) }}</p>
</div>
<div>
<span class="text-gray-500">Kilometraje Actual</span>
<p class="font-semibold mt-0.5">{{ number_format($cargaDiesel->km_actual) }} km</p>
</div>
<div>
<span class="text-gray-500">Observaciones</span>
<p class="font-semibold mt-0.5">{{ $cargaDiesel->observaciones ?? '—' }}</p>
</div>
<div>
<span class="text-gray-500">Creado</span>
<p class="font-semibold mt-0.5">{{ $cargaDiesel->created_at->format('d/m/Y H:i') }}</p>
</div>
<div>
<span class="text-gray-500">Actualizado</span>
<p class="font-semibold mt-0.5">{{ $cargaDiesel->updated_at->format('d/m/Y H:i') }}</p>
</div>
</div>
</div>
</div>
@can('admin')<div class="flex items-center gap-3 mt-5">
<a href="{{ route('cargas-diesel.edit', $cargaDiesel) }}" class="btn btn-primary">Editar</a>
<form method="POST" action="{{ route('cargas-diesel.destroy', $cargaDiesel) }}" data-confirm="¿Eliminar esta carga?">@csrf @method('DELETE')<button type="submit" class="btn btn-secondary">Eliminar</button></form>
</div>@endcan
</div>@endsection
