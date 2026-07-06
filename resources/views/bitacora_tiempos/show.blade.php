@extends('layouts.app')@section('title', 'Bitácora de Tiempos')@section('content')<div class="max-w-3xl mx-auto">
<div class="flex items-center justify-between mb-6">
<div>
<h2 class="text-2xl font-extrabold tracking-tight">Bitácora de Tiempos</h2>
<p class="text-sm text-gray-500">Servicio #{{ $bitacoraTiempo->servicio?->id }} — {{ $bitacoraTiempo->servicio?->cotizacion?->folio ?? 'Sin folio' }}</p>
</div>
<a href="{{ route('bitacora-tiempos.index') }}" class="btn btn-secondary">← Volver</a>
</div>
<div class="card">
<div class="card-header"><h3>Línea de Tiempo</h3></div>
<div class="card-body">
<div class="space-y-4">
<div class="flex items-center gap-4">
<div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold {{ $bitacoraTiempo->hora_asignado ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-400' }}">
<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
</div>
<div>
<p class="font-semibold text-sm">Asignado</p>
<p class="text-sm text-gray-500">{{ $bitacoraTiempo->hora_asignado?->format('d/m/Y H:i') ?: '—' }}</p>
</div>
</div>
<div class="flex items-center gap-4">
<div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold {{ $bitacoraTiempo->hora_inicio_servicio ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-400' }}">
<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
</div>
<div>
<p class="font-semibold text-sm">Inicio de Servicio</p>
<p class="text-sm text-gray-500">{{ $bitacoraTiempo->hora_inicio_servicio?->format('d/m/Y H:i') ?: '—' }}</p>
</div>
</div>
<div class="flex items-center gap-4">
<div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold {{ $bitacoraTiempo->hora_en_sitio_origen ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-400' }}">
<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
</div>
<div>
<p class="font-semibold text-sm">En Sitio (Origen)</p>
<p class="text-sm text-gray-500">{{ $bitacoraTiempo->hora_en_sitio_origen?->format('d/m/Y H:i') ?: '—' }}</p>
</div>
</div>
<div class="flex items-center gap-4">
<div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold {{ $bitacoraTiempo->hora_salida_destino ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-400' }}">
<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
</div>
<div>
<p class="font-semibold text-sm">Salida a Destino</p>
<p class="text-sm text-gray-500">{{ $bitacoraTiempo->hora_salida_destino?->format('d/m/Y H:i') ?: '—' }}</p>
</div>
</div>
<div class="flex items-center gap-4">
<div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold {{ $bitacoraTiempo->hora_en_destino ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-400' }}">
<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
</div>
<div>
<p class="font-semibold text-sm">En Destino</p>
<p class="text-sm text-gray-500">{{ $bitacoraTiempo->hora_en_destino?->format('d/m/Y H:i') ?: '—' }}</p>
</div>
</div>
<div class="flex items-center gap-4">
<div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold {{ $bitacoraTiempo->hora_finalizado ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-400' }}">
<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
</div>
<div>
<p class="font-semibold text-sm">Finalizado</p>
<p class="text-sm text-gray-500">{{ $bitacoraTiempo->hora_finalizado?->format('d/m/Y H:i') ?: '—' }}</p>
</div>
</div>
</div>
</div>
</div>
<div class="mt-5">
<div class="card">
<div class="card-header"><h3>Datos del Servicio</h3></div>
<div class="card-body">
<div class="grid grid-cols-2 gap-4 text-sm">
<div>
<span class="text-gray-500">Operador</span>
<p class="font-semibold mt-0.5">{{ $bitacoraTiempo->servicio?->operador?->empleado?->nombreCompleto() ?: '—' }}</p>
</div>
<div>
<span class="text-gray-500">Unidad</span>
<p class="font-semibold mt-0.5">{{ $bitacoraTiempo->servicio?->unidad?->marca }} {{ $bitacoraTiempo->servicio?->unidad?->placas }}</p>
</div>
<div>
<span class="text-gray-500">Cliente</span>
<p class="font-semibold mt-0.5">{{ $bitacoraTiempo->servicio?->cotizacion?->cliente?->nombre ?? '—' }}</p>
</div>
<div>
<span class="text-gray-500">Folio Cotización</span>
<p class="font-semibold mt-0.5">{{ $bitacoraTiempo->servicio?->cotizacion?->folio ?? '—' }}</p>
</div>
</div>
</div>
</div>
</div>
@can('empleado')<div class="flex items-center gap-3 mt-5">
<a href="{{ route('bitacora-tiempos.edit', $bitacoraTiempo) }}" class="btn btn-primary">Editar</a>
@can('admin')<form method="POST" action="{{ route('bitacora-tiempos.destroy', $bitacoraTiempo) }}" data-confirm="¿Eliminar esta bitácora?">@csrf @method('DELETE')<button type="submit" class="btn btn-secondary">Eliminar</button></form>@endcan
</div>@endcan
</div>@endsection
