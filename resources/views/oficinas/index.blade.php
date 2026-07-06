@extends('layouts.app')@section('title', 'Oficinas')@section('content')<div class="max-w-7xl mx-auto">    @if (session('success'))        <div class="mb-5 px-5 py-3.5 rounded-xl text-sm font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200">{{ session('success') }}</div>    @endif    <div class="card">
<div class="card-header">
<h3>Oficinas</h3>
@can('admin')<a href="{{ route('oficinas.create') }}" class="btn btn-primary">+ Nueva Oficina</a>@endcan
</div>
<div class="table-container">
<table>
<thead>
<tr>
<th>ID</th>
<th>Nombre</th>
<th>Dirección</th>
<th>Ciudad</th>
<th>Estado</th>
<th>Teléfono</th>
<th>Encargado</th>
<th>Acciones</th>
</tr>
</thead>
<tbody>                    @forelse ($oficinas as $o)                    <tr>
<td><strong>#{{ $o->id }}</strong></td>
<td><strong>{{ $o->nombre }}</strong></td>
<td>{{ $o->direccion ?? '—' }}</td>
<td>{{ $o->ciudad ?? '—' }}</td>
<td>{{ $o->estado ?? '—' }}</td>
<td>{{ $o->telefono ?? '—' }}</td>
<td>{{ $o->encargado ?? '—' }}</td>
<td>
<div class="flex items-center gap-2">
<a href="{{ route('oficinas.show', $o) }}" class="btn btn-sm btn-ghost">Ver</a>
@can('admin')<a href="{{ route('oficinas.edit', $o) }}" class="btn btn-sm btn-primary">Editar</a>@endcan
@can('admin')<form method="POST" action="{{ route('oficinas.destroy', $o) }}" data-confirm="¿Eliminar esta oficina?">                                    @csrf @method('DELETE')                                    <button type="submit" class="btn btn-sm btn-secondary">Eliminar</button>
</form>@endcan
</div>
</td>
</tr>                    @empty                    <tr>
<td colspan="8" class="text-center text-gray-500 py-8">No hay oficinas registradas.</td>
</tr>                    @endforelse                </tbody>
</table>
</div>
<div class="px-5 py-3 border-t border-gray-100">
{{ $oficinas->links() }}
</div>
</div>
</div>@endsection
