@extends('layouts.app')@section('title', 'Autorizaciones de Cancelación')@section('content')<div class="max-w-7xl mx-auto">    @if (session('success'))        <div class="mb-5 px-5 py-3.5 rounded-xl text-sm font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200">{{ session('success') }}</div>    @endif    <div class="card">
<div class="card-header">
<h3>Autorizaciones de Cancelación</h3>
@can('empleado')<a href="{{ route('autorizaciones-cancelacion.create') }}" class="btn btn-primary">+ Nueva Solicitud</a>@endcan
</div>
<div class="table-container">
<table>
<thead>
<tr>
<th>Servicio</th>
<th>Cliente</th>
<th>Solicitante</th>
<th>Tipo</th>
<th>Estatus</th>
<th>Solicitud</th>
<th>Resolución</th>
<th>Acciones</th>
</tr>
</thead>
<tbody>                    @forelse ($autorizaciones as $a)                    <tr>
<td>#{{ $a->servicio?->id }}</td>
<td>{{ $a->servicio?->cotizacion?->cliente?->nombre ?? '—' }}</td>
<td>{{ $a->usuarioSolicitante?->name ?? '—' }}</td>
<td>{{ str_replace('_', ' ', ucfirst($a->tipo_incidencia)) }}</td>
<td>
<span class="px-2.5 py-1 rounded-full text-xs font-semibold
@if($a->estatus === 'pendiente') bg-yellow-100 text-yellow-800
@elseif($a->estatus === 'cancelado_por_cotizador') bg-red-100 text-red-800
@else bg-gray-100 text-gray-800 @endif">
{{ str_replace('_', ' ', ucfirst($a->estatus)) }}
</span>
</td>
<td>{{ $a->fecha_solicitud?->format('d/m/Y H:i') }}</td>
<td>{{ $a->fecha_resolucion?->format('d/m/Y H:i') ?: '—' }}</td>
<td>
<div class="flex items-center gap-2">
<a href="{{ route('autorizaciones-cancelacion.show', $a) }}" class="btn btn-sm btn-ghost">Ver</a>
@can('admin')<a href="{{ route('autorizaciones-cancelacion.edit', $a) }}" class="btn btn-sm btn-primary">Resolver</a>@endcan
</div>
</td>
</tr>                    @empty                    <tr>
<td colspan="8" class="text-center text-gray-500 py-8">No hay solicitudes registradas.</td>
</tr>                    @endforelse                </tbody>
</table>
</div>
<div class="px-5 py-3 border-t border-gray-100">
{{ $autorizaciones->links() }}
</div>
</div>
</div>@endsection
