@extends('layouts.app')
@section('title', 'Mis Servicios')
@section('content')
<div class="page-header">
    <div>
        <h2 class="page-title">Mis Servicios</h2>
        <p class="page-description">Consulta y da seguimiento a tus servicios de grúa.</p>
    </div>
</div>

<div class="card mb-5">
    <div class="card-body">
        <form method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div>
                <label class="label">Buscar</label>
                <input type="text" name="q" placeholder="Folio..." value="{{ request('q') }}" class="input">
            </div>
            <div>
                <label class="label">Estado</label>
                <select name="estado" class="input">
                    <option value="">Todos</option>
                    <option value="asignado" @selected(request('estado') === 'asignado')>Asignado</option>
                    <option value="inicio_servicio" @selected(request('estado') === 'inicio_servicio')>Inicio Servicio</option>
                    <option value="en_sitio_origen" @selected(request('estado') === 'en_sitio_origen')>En Sitio Origen</option>
                    <option value="en_carga" @selected(request('estado') === 'en_carga')>En Carga</option>
                    <option value="en_transito" @selected(request('estado') === 'en_transito')>En Tránsito</option>
                    <option value="en_sitio_destino" @selected(request('estado') === 'en_sitio_destino')>En Sitio Destino</option>
                    <option value="finalizado" @selected(request('estado') === 'finalizado')>Finalizado</option>
                    <option value="cancelado" @selected(request('estado') === 'cancelado')>Cancelado</option>
                </select>
            </div>
            <div>
                <label class="label">Desde</label>
                <input type="date" name="fecha_desde" value="{{ request('fecha_desde') }}" class="input">
            </div>
            <div>
                <label class="label">Hasta</label>
                <input type="date" name="fecha_hasta" value="{{ request('fecha_hasta') }}" class="input">
            </div>
            <div class="sm:col-span-2 lg:col-span-4 flex gap-2">
                <button type="submit" class="btn-primary">Filtrar</button>
                <a href="{{ route('clientes.servicios') }}" class="btn-secondary">Limpiar</a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Folio</th>
                        <th>Servicio</th>
                        <th>Tipo</th>
                        <th>Estatus</th>
                        <th>Operador</th>
                        <th>Unidad</th>
                        <th>Fecha</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($servicios as $servicio)
                        <tr>
                            <td>
                                <a href="{{ route('clientes.servicio-show', $servicio) }}" class="table-link">
                                    #{{ $servicio->cotizacion->folio ?? 'N/A' }}
                                </a>
                            </td>
                            <td class="text-gray-600">
                                {{ $servicio->cotizacion->origen_direccion ?? '-' }} → {{ $servicio->cotizacion->destino_direccion ?? '-' }}
                            </td>
                            <td>
                                <span class="badge badge-gray">{{ $servicio->tipoServicio->nombre ?? $servicio->cotizacion->tipoServicio->nombre ?? '-' }}</span>
                            </td>
                            <td>
                                @php
                                    $badges = [
                                        'asignado' => 'badge-blue',
                                        'inicio_servicio' => 'badge-purple',
                                        'en_sitio_origen' => 'badge-purple',
                                        'en_carga' => 'badge-purple',
                                        'en_transito' => 'badge-indigo',
                                        'en_sitio_destino' => 'badge-indigo',
                                        'finalizado' => 'badge-green',
                                        'cancelado' => 'badge-red',
                                    ];
                                @endphp
                                <span class="badge {{ $badges[$servicio->estado] ?? 'badge-gray' }}">
                                    {{ ucfirst(str_replace('_', ' ', $servicio->estado)) }}
                                </span>
                            </td>
                            <td class="text-gray-600">{{ $servicio->operador?->empleado?->nombre ?? '—' }}</td>
                            <td class="text-gray-600">{{ $servicio->unidad?->numero_economico ?? '—' }}</td>
                            <td class="text-gray-500 text-sm">{{ $servicio->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('clientes.servicio-show', $servicio) }}" class="btn-icon" title="Ver detalle">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="text-center py-8 text-gray-500">No hay servicios registrados.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-100">
            {{ $servicios->links() }}
        </div>
    </div>
</div>
@endsection
