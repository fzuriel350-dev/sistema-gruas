@extends('layouts.app')@section('title', 'Bitácora de Tiempos')@section('content')<div class="max-w-7xl mx-auto">    @if (session('success'))        <div class="mb-5 px-5 py-3.5 rounded-xl text-sm font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200">{{ session('success') }}</div>    @endif    <div class="card">
<div class="card-header">
<h3>Bitácora de Tiempos</h3>
@can('empleado')<a href="{{ route('bitacora-tiempos.create') }}" class="btn btn-primary">+ Nueva Bitácora</a>@endcan
</div>
<div class="table-container">
<table>
<thead>
<tr>
<th>Servicio</th>
<th>Cliente</th>
<th>Asignado</th>
<th>Inicio</th>
<th>En Sitio</th>
<th>Salida Destino</th>
<th>En Destino</th>
<th>Finalizado</th>
<th>Acciones</th>
</tr>
</thead>
<tbody>                    @forelse ($bitacoras as $b)                    <tr>
<td>#{{ $b->servicio?->id }}</td>
<td>{{ $b->servicio?->cotizacion?->cliente?->nombre ?? '—' }}</td>
<td>{{ $b->hora_asignado?->format('d/m H:i') ?: '—' }}</td>
<td>{{ $b->hora_inicio_servicio?->format('d/m H:i') ?: '—' }}</td>
<td>{{ $b->hora_en_sitio_origen?->format('d/m H:i') ?: '—' }}</td>
<td>{{ $b->hora_salida_destino?->format('d/m H:i') ?: '—' }}</td>
<td>{{ $b->hora_en_destino?->format('d/m H:i') ?: '—' }}</td>
<td>{{ $b->hora_finalizado?->format('d/m H:i') ?: '—' }}</td>
<td>
<div class="flex items-center gap-2">
<a href="{{ route('bitacora-tiempos.show', $b) }}" class="btn btn-sm btn-ghost">Ver</a>
@can('empleado')<a href="{{ route('bitacora-tiempos.edit', $b) }}" class="btn btn-sm btn-primary">Editar</a>@endcan
@can('admin')<form method="POST" action="{{ route('bitacora-tiempos.destroy', $b) }}" data-confirm="¿Eliminar esta bitácora?">                                    @csrf @method('DELETE')                                    <button type="submit" class="btn btn-sm btn-secondary">Eliminar</button>
</form>@endcan
</div>
</td>
</tr>                    @empty                    <tr>
<td colspan="9" class="text-center text-gray-500 py-8">No hay bitácoras registradas.</td>
</tr>                    @endforelse                </tbody>
</table>
</div>
<div class="px-5 py-3 border-t border-gray-100">
{{ $bitacoras->links() }}
</div>
</div>
</div>@endsection
