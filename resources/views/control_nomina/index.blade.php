@extends('layouts.app')@section('title', 'Control de Nómina')@section('content')<div class="max-w-7xl mx-auto">    @if (session('success'))        <div class="mb-5 px-5 py-3.5 rounded-xl text-sm font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200">{{ session('success') }}</div>    @endif    <div class="card">
<div class="card-header">
<h3>Control de Nómina</h3>
@can('admin')<a href="{{ route('control-nomina.create') }}" class="btn btn-primary">+ Nueva Nómina</a>@endcan
</div>
<div class="table-container">
<table>
<thead>
<tr>
<th>#</th>
<th>Operador</th>
<th>Período</th>
<th>Sueldo Base</th>
<th>Bonos</th>
<th>Descuentos</th>
<th>Total Neto</th>
<th>Estatus</th>
<th>Acciones</th>
</tr>
</thead>
<tbody>                    @forelse ($nominas as $n)                    <tr>
<td>#{{ $n->operador_id }}</td>
<td>{{ $n->operador?->empleado?->nombre ?? '—' }}</td>
<td>{{ $n->fecha_desde->format('d/m/Y') }} - {{ $n->fecha_hasta->format('d/m/Y') }}</td>
<td>${{ number_format($n->sueldo_base_semanal, 2) }}</td>
<td>${{ number_format($n->bonos_servicios, 2) }}</td>
<td>${{ number_format($n->descuentos_prestamos, 2) }}</td>
<td><strong>${{ number_format($n->total_neto_a_pagar, 2) }}</strong></td>
<td>
<span class="px-2.5 py-1 rounded-full text-xs font-semibold
@if($n->estatus === 'pagado') bg-emerald-100 text-emerald-800
@else bg-amber-100 text-amber-800 @endif">
{{ ucfirst($n->estatus) }}
</span>
</td>
<td>
<div class="flex items-center gap-2">
<a href="{{ route('control-nomina.show', $n) }}" class="btn btn-sm btn-ghost">Ver</a>
@can('admin')<a href="{{ route('control-nomina.edit', $n) }}" class="btn btn-sm btn-primary">Editar</a>@endcan
@can('admin')<form method="POST" action="{{ route('control-nomina.destroy', $n) }}" data-confirm="¿Eliminar esta nómina?">                                    @csrf @method('DELETE')                                    <button type="submit" class="btn btn-sm btn-secondary">Eliminar</button>
</form>@endcan
</div>
</td>
</tr>                    @empty                    <tr>
<td colspan="9" class="text-center text-gray-500 py-8">No hay registros de nómina.</td>
</tr>                    @endforelse                </tbody>
</table>
</div>
<div class="px-5 py-3 border-t border-gray-100">
{{ $nominas->links() }}
</div>
</div>
</div>@endsection
