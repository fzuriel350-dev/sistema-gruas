@extends('layouts.app')@section('title', 'Solicitud de Cancelación')@section('content')<div class="max-w-3xl mx-auto">
<div class="flex items-center justify-between mb-6">
<div>
<h2 class="text-2xl font-extrabold tracking-tight">Solicitud de Cancelación</h2>
<p class="text-sm text-gray-500">Servicio #{{ $autorizacionCancelacion->servicio?->id }}</p>
</div>
<a href="{{ route('autorizaciones-cancelacion.index') }}" class="btn btn-secondary">← Volver</a>
</div>
<div class="card">
<div class="card-header"><h3>Detalles</h3></div>
<div class="card-body">
<div class="grid grid-cols-2 gap-4 text-sm">
<div>
<span class="text-gray-500">Servicio</span>
<p class="font-semibold mt-0.5">#{{ $autorizacionCancelacion->servicio?->id }}</p>
</div>
<div>
<span class="text-gray-500">Folio Cotización</span>
<p class="font-semibold mt-0.5">{{ $autorizacionCancelacion->servicio?->cotizacion?->folio ?? '—' }}</p>
</div>
<div>
<span class="text-gray-500">Cliente</span>
<p class="font-semibold mt-0.5">{{ $autorizacionCancelacion->servicio?->cotizacion?->cliente?->nombre ?? '—' }}</p>
</div>
<div>
<span class="text-gray-500">Operador</span>
<p class="font-semibold mt-0.5">{{ $autorizacionCancelacion->servicio?->operador?->empleado?->nombreCompleto() ?: '—' }}</p>
</div>
<div>
<span class="text-gray-500">Solicitante</span>
<p class="font-semibold mt-0.5">{{ $autorizacionCancelacion->usuarioSolicitante?->name ?? '—' }}</p>
</div>
<div>
<span class="text-gray-500">Tipo de Incidencia</span>
<p class="font-semibold mt-0.5">{{ str_replace('_', ' ', ucfirst($autorizacionCancelacion->tipo_incidencia)) }}</p>
</div>
<div>
<span class="text-gray-500">Estatus</span>
<p class="font-semibold mt-0.5">
<span class="px-2.5 py-1 rounded-full text-xs font-semibold
@if($autorizacionCancelacion->estatus === 'pendiente') bg-yellow-100 text-yellow-800
@elseif($autorizacionCancelacion->estatus === 'cancelado_por_cotizador') bg-red-100 text-red-800
@else bg-gray-100 text-gray-800 @endif">
{{ str_replace('_', ' ', ucfirst($autorizacionCancelacion->estatus)) }}
</span>
</p>
</div>
<div>
<span class="text-gray-500">Resolutor</span>
<p class="font-semibold mt-0.5">{{ $autorizacionCancelacion->usuarioResolutor?->name ?? '—' }}</p>
</div>
<div>
<span class="text-gray-500">Fecha de Solicitud</span>
<p class="font-semibold mt-0.5">{{ $autorizacionCancelacion->fecha_solicitud?->format('d/m/Y H:i') }}</p>
</div>
<div>
<span class="text-gray-500">Fecha de Resolución</span>
<p class="font-semibold mt-0.5">{{ $autorizacionCancelacion->fecha_resolucion?->format('d/m/Y H:i') ?: '—' }}</p>
</div>
</div>
<div class="mt-5 p-4 rounded-lg bg-gray-50">
<span class="text-gray-500 text-sm">Motivo de Cancelación</span>
<p class="font-semibold mt-1">{{ $autorizacionCancelacion->motivo_cancelacion }}</p>
</div>
</div>
</div>
@can('admin')<div class="flex items-center gap-3 mt-5">
@if ($autorizacionCancelacion->estatus === 'pendiente')
<a href="{{ route('autorizaciones-cancelacion.edit', $autorizacionCancelacion) }}" class="btn btn-primary">Resolver</a>
@endif
<form method="POST" action="{{ route('autorizaciones-cancelacion.destroy', $autorizacionCancelacion) }}" data-confirm="¿Eliminar esta solicitud?">@csrf @method('DELETE')<button type="submit" class="btn btn-secondary">Eliminar</button></form>
</div>@endcan
</div>@endsection
