@extends('layouts.app')@section('title', $serviciosConfigurado->nombre)@section('content')<div class="max-w-3xl mx-auto">
<div class="flex items-center justify-between mb-6">
<div>
<h2 class="text-2xl font-extrabold tracking-tight">{{ $serviciosConfigurado->nombre }}</h2>
<p class="text-sm text-gray-500">
<span class="px-2.5 py-1 rounded-full text-xs font-semibold
@if($serviciosConfigurado->activo) bg-emerald-100 text-emerald-800
@else bg-gray-100 text-gray-600 @endif">
{{ $serviciosConfigurado->activo ? 'Activo' : 'Inactivo' }}
</span>
</p>
</div>
<a href="{{ route('servicios-configurados.index') }}" class="btn btn-secondary">← Volver</a>
</div>
<div class="card">
<div class="card-header"><h3>Detalle del servicio configurado</h3></div>
<div class="card-body">
<div class="grid grid-cols-2 gap-4 text-sm">
<div>
<span class="text-gray-500">Nombre</span>
<p class="font-semibold mt-0.5">{{ $serviciosConfigurado->nombre }}</p>
</div>
<div>
<span class="text-gray-500">Cliente</span>
<p class="font-semibold mt-0.5">{{ $serviciosConfigurado->cliente?->nombre ?? '—' }}</p>
</div>
<div>
<span class="text-gray-500">Tipo de Servicio</span>
<p class="font-semibold mt-0.5">{{ $serviciosConfigurado->tipoServicio?->nombre ?? '—' }}</p>
</div>
<div>
<span class="text-gray-500">Tipo</span>
<p class="font-semibold mt-0.5">{{ ucfirst($serviciosConfigurado->tipo) }}</p>
</div>
<div>
<span class="text-gray-500">Costo Banderazo</span>
<p class="font-semibold mt-0.5">${{ number_format($serviciosConfigurado->costo_banderazo, 2) }}</p>
</div>
<div>
<span class="text-gray-500">Costo por Km</span>
<p class="font-semibold mt-0.5">${{ number_format($serviciosConfigurado->costo_km, 2) }}</p>
</div>
<div class="col-span-2">
<span class="text-gray-500">Observaciones</span>
<p class="font-semibold mt-0.5">{{ $serviciosConfigurado->observaciones ?? '—' }}</p>
</div>
</div>
</div>
</div>
@can('admin')<div class="flex items-center gap-3 mt-5">
<a href="{{ route('servicios-configurados.edit', $serviciosConfigurado) }}" class="btn btn-primary">Editar</a>
<form method="POST" action="{{ route('servicios-configurados.destroy', $serviciosConfigurado) }}" data-confirm="¿Eliminar este servicio configurado?">@csrf @method('DELETE')<button type="submit" class="btn btn-secondary">Eliminar</button></form>
</div>@endcan
</div>@endsection
