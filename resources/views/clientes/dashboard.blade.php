@extends('layouts.app')
@section('title', 'Mi Panel')
@section('content')
<div class="max-w-7xl mx-auto">
    @if (session('success'))
        <div class="mb-5 px-5 py-3.5 rounded-xl text-sm font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200">
            {{ session('success') }}
        </div>
    @endif

    <div class="welcome-banner rounded-xl p-5 lg:p-7 mb-6 relative overflow-hidden">
        <div class="absolute right-[-40px] top-[-40px] w-[180px] h-[180px] rounded-full" style="background: radial-gradient(circle, rgba(255,213,0,0.08) 0%, transparent 70%);"></div>
        <div class="absolute left-0 bottom-0 w-full h-[3px]" style="background: linear-gradient(90deg, var(--geg-yellow), transparent);"></div>
        <div>
            <h2 class="text-xl font-bold text-white mb-1">Hola, <span style="color: var(--geg-yellow);">{{ Auth::user()->name }}</span></h2>
            <p class="text-[13.5px] text-white/60">Bienvenido a tu panel de control</p>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">
        <div class="stat-card">
            <div class="stat-icon" style="background: var(--geg-yellow-light); color: var(--geg-yellow-dark);">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ $pendientes }}</div>
                <div class="stat-label">Cotizaciones pendientes</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: #d1fae5; color: var(--geg-success);">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ $aprobadas }}</div>
                <div class="stat-label">Cotizaciones aprobadas</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: #fef3c7; color: var(--geg-yellow-dark);">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ $activos }}</div>
                <div class="stat-label">Servicios activos</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: #ede9fe; color: #7c3aed;">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ $finalizados }}</div>
                <div class="stat-label">Servicios finalizados</div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-[1.6fr_1fr] gap-5 mb-5">
        <div class="card">
            <div class="card-header">
                <h3>Servicios por mes</h3>
                <span class="text-xs font-semibold px-3 py-1 rounded-full" style="background: var(--geg-yellow-light); color: var(--geg-yellow-dark);">{{ now()->year }}</span>
            </div>
            <div class="card-body">
                <div class="flex items-end gap-3 h-[180px] pt-4">
                    @foreach (range(1, 12) as $m)
                        @php
                            $total = $serviciosPorMes->get(str_pad($m, 2, '0', STR_PAD_LEFT), 0);
                            $max = $serviciosPorMes->max() ?: 1;
                            $height = max(round(($total / $max) * 100), $total > 0 ? 8 : 0);
                            $meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
                        @endphp
                        <div class="flex-1 flex flex-col items-center gap-1.5 h-full justify-end">
                            <span class="text-[11px] font-bold text-gray-800 order-first">{{ $total }}</span>
                            <div class="chart-bar" style="height: {{ $height }}%;"></div>
                            <span class="text-[11px] text-gray-500 font-medium">{{ $meses[$m - 1] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3>Actividad reciente</h3>
            </div>
            <div class="card-body py-2">
                @forelse ($actividades as $activity)
                    <div class="flex items-start gap-3 px-4 py-2.5 rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="activity-dot activity-dot-{{ $activity['dot'] }}"></div>
                        <div class="flex-1 min-w-0">
                            <div class="text-xs text-gray-800 leading-tight">{!! $activity['text'] !!}</div>
                            <div class="text-[11px] text-gray-500 mt-0.5">{{ $activity['time'] }}</div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 text-gray-500 text-sm">Aún no tienes actividad.</div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3>Accesos rápidos</h3>
        </div>
        <div class="card-body">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <a href="{{ route('clientes.cotizaciones') }}" class="flex items-center gap-4 p-4 rounded-xl border border-gray-100 hover:border-[#FFD500] hover:bg-[#FFFDF0] transition-all">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: var(--geg-yellow-light);">
                        <svg class="w-5 h-5" style="color: var(--geg-yellow-dark);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <div class="font-semibold text-sm text-gray-800">Mis cotizaciones</div>
                        <div class="text-xs text-gray-500">Ver y gestionar cotizaciones</div>
                    </div>
                </a>
                <a href="{{ route('clientes.servicios') }}" class="flex items-center gap-4 p-4 rounded-xl border border-gray-100 hover:border-[#FFD500] hover:bg-[#FFFDF0] transition-all">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: #d1fae5;">
                        <svg class="w-5 h-5" style="color: var(--geg-success);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div>
                        <div class="font-semibold text-sm text-gray-800">Mis servicios</div>
                        <div class="text-xs text-gray-500">Dar seguimiento a tus servicios</div>
                    </div>
                </a>
                <a href="{{ route('clientes.notificaciones') }}" class="flex items-center gap-4 p-4 rounded-xl border border-gray-100 hover:border-[#FFD500] hover:bg-[#FFFDF0] transition-all">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: #fef3c7;">
                        <svg class="w-5 h-5" style="color: var(--geg-yellow-dark);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </div>
                    <div>
                        <div class="font-semibold text-sm text-gray-800">Notificaciones</div>
                        <div class="text-xs text-gray-500">Ver tus notificaciones</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
