@extends('layouts.app')@section('title', 'Cargas de Diesel')@section('content')<div class="max-w-7xl mx-auto">    @if (session('success'))        <div class="mb-5 px-5 py-3.5 rounded-xl text-sm font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200">{{ session('success') }}</div>    @endif    <div class="card">
<div class="card-header">
<h3>Cargas de Diesel</h3>
@can('admin')<a href="{{ route('cargas-diesel.create') }}" class="btn btn-primary">+ Nueva Carga</a>@endcan
</div>
<div class="table-container">
<table>
<thead>
<tr>
<th>#</th>
<th>Fecha</th>
<th>Unidad</th>
<th>Operador</th>
<th>Litros</th>
<th>Costo/L</th>
<th>Importe</th>
<th>Km Actual</th>
<th>Acciones</th>
</tr>
</thead>
<tbody>                    @forelse ($cargas as $c)                    <tr>
<td class="text-gray-400 text-xs">{{ $c->id }}</td>
<td>{{ $c->fecha_carga?->format('d/m/Y H:i') }}</td>
<td>{{ $c->unidad?->marca }} {{ $c->unidad?->placas }}</td>
<td>{{ $c->operador?->empleado?->nombreCompleto() ?: '—' }}</td>
<td>{{ number_format($c->litros, 2) }} L</td>
<td>${{ number_format($c->costo_litro, 2) }}</td>
<td>${{ number_format($c->importe_total, 2) }}</td>
<td>{{ number_format($c->km_actual) }} km</td>
<td>
<div class="flex items-center gap-2">
<a href="{{ route('cargas-diesel.show', $c) }}" class="btn btn-sm btn-ghost">Ver</a>
@can('admin')<a href="{{ route('cargas-diesel.edit', $c) }}" class="btn btn-sm btn-primary">Editar</a>@endcan
@can('admin')<form method="POST" action="{{ route('cargas-diesel.destroy', $c) }}" data-confirm="¿Eliminar esta carga?">                                    @csrf @method('DELETE')                                    <button type="submit" class="btn btn-sm btn-secondary">Eliminar</button>
</form>@endcan
</div>
</td>
</tr>                    @empty                    <tr>
<td colspan="9" class="text-center text-gray-500 py-8">No hay cargas registradas.</td>
</tr>                    @endforelse                </tbody>
</table>
</div>
<div class="px-5 py-3 border-t border-gray-100">
{{ $cargas->links() }}
</div>
</div>
</div>@endsection
