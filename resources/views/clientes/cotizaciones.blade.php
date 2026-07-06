@extends('layouts.app')
@section('title', 'Mis Cotizaciones')
@section('content')
<div class="page-header">
    <div>
        <h2 class="page-title">Mis Cotizaciones</h2>
        <p class="page-description">Todas tus cotizaciones de servicio de grúa.</p>
    </div>
    <a href="{{ route('cotizaciones.create') }}" class="btn-primary">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Nueva cotización
    </a>
</div>

<div class="card mb-5">
    <div class="card-body">
        <form method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <div>
                <label class="label">Buscar</label>
                <input type="text" name="q" placeholder="Folio, origen o destino..." value="{{ request('q') }}" class="input">
            </div>
            <div>
                <label class="label">Estatus</label>
                <select name="estatus" class="input">
                    <option value="">Todos</option>
                    <option value="pendiente" @selected(request('estatus') === 'pendiente')>Pendiente</option>
                    <option value="aprobado" @selected(request('estatus') === 'aprobado')>Aprobado</option>
                    <option value="rechazado" @selected(request('estatus') === 'rechazado')>Rechazado</option>
                </select>
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="btn-primary">Filtrar</button>
                <a href="{{ route('clientes.cotizaciones') }}" class="btn-secondary">Limpiar</a>
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
                        <th>Vehículo</th>
                        <th>Total</th>
                        <th>Estatus</th>
                        <th>Fecha</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cotizaciones as $cotizacion)
                        <tr>
                            <td>
                                <span class="font-mono font-semibold text-sm">#{{ $cotizacion->folio }}</span>
                            </td>
                            <td class="text-gray-600 text-sm">
                                {{ $cotizacion->origen }} → {{ $cotizacion->destino }}
                            </td>
                            <td>
                                <span class="badge badge-gray">{{ $cotizacion->tipoServicio->nombre ?? '-' }}</span>
                            </td>
                            <td class="text-sm text-gray-600">
                                {{ $cotizacion->marca }} {{ $cotizacion->modelo }}
                            </td>
                            <td class="font-semibold text-sm">
                                ${{ number_format($cotizacion->subtotal + ($cotizacion->iva ?? 0) - ($cotizacion->descuento ?? 0), 2) }}
                            </td>
                            <td>
                                @php
                                    $badges = [
                                        'pendiente' => 'badge-yellow',
                                        'aprobado' => 'badge-green',
                                        'rechazado' => 'badge-red',
                                    ];
                                @endphp
                                <span class="badge {{ $badges[$cotizacion->estatus] ?? 'badge-gray' }}">
                                    {{ ucfirst($cotizacion->estatus) }}
                                </span>
                            </td>
                            <td class="text-gray-500 text-sm">{{ $cotizacion->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="flex items-center gap-1 justify-end">
                                    <a href="{{ route('cotizaciones.show', $cotizacion) }}" class="btn-icon" title="Ver detalle">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    @if ($cotizacion->estatus === 'pendiente')
                                        <form method="POST" action="{{ route('clientes.cotizaciones.aprobar', $cotizacion) }}" class="inline" data-confirm="¿Estás seguro de aprobar esta cotización? Se generará un servicio automáticamente.">
                                            @csrf
                                            <button type="submit" class="btn-icon text-emerald-600 hover:bg-emerald-50" title="Aprobar">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </button>
                                        </form>
                                        <button type="button" class="btn-icon text-red-500 hover:bg-red-50" title="Rechazar" onclick="document.getElementById('rechazar-modal-{{ $cotizacion->id }}').classList.remove('hidden')">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="text-center py-8 text-gray-500">No hay cotizaciones registradas.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-100">
            {{ $cotizaciones->links() }}
        </div>
    </div>
</div>

@foreach ($cotizaciones as $cotizacion)
    <div id="rechazar-modal-{{ $cotizacion->id }}" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40" onclick="if(event.target===this)this.classList.add('hidden')">
        <div class="bg-white rounded-xl p-6 w-full max-w-md shadow-2xl" onclick="event.stopPropagation()">
            <h3 class="text-lg font-bold text-gray-800 mb-2">Rechazar cotización</h3>
            <p class="text-sm text-gray-600 mb-4">Cotización #{{ $cotizacion->folio }}</p>
            <form method="POST" action="{{ route('clientes.cotizaciones.rechazar', $cotizacion) }}">
                @csrf
                <div class="mb-4">
                    <label class="label">Motivo (opcional)</label>
                    <textarea name="motivo" rows="3" class="input" placeholder="Indica por qué rechazas esta cotización..."></textarea>
                </div>
                <div class="flex gap-2 justify-end">
                    <button type="button" class="btn-secondary" onclick="this.closest('[id^=rechazar-modal]').classList.add('hidden')">Cancelar</button>
                    <button type="submit" class="btn-primary" style="background: var(--geg-red, #ef4444);">Rechazar</button>
                </div>
            </form>
        </div>
    </div>
@endforeach
@endsection
