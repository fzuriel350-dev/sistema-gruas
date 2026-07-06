@extends('layouts.app')@section('title', 'Nueva Cotización')@section('content')<div class="max-w-7xl mx-auto">
<form method="POST" action="{{ route('cotizaciones.store') }}" x-data="cotizacionForm()">        @csrf
<div class="grid grid-cols-1 lg:grid-cols-[1.5fr_1fr] gap-5">
<div class="space-y-5">
<div class="card">
<div class="card-header">
<h3>Datos del Cliente</h3>
</div>
<div class="card-body">
<div class="form-grid">
<div class="form-group">
<label>Cliente</label>
<select name="cliente_id">
<option value="">Sin cliente registrado...</option>                                    @foreach ($clientes as $cliente)                                    <option value="{{ $cliente->id }}" @selected(old('cliente_id') == $cliente->id)>                                        {{ $cliente->nombre }}                                    </option>                                    @endforeach                                </select>                                @error('cliente_id') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror                            </div>
<div class="form-group">
<label>Aseguradora</label>
<select name="aseguradora_id" required>
<option value="">Seleccionar...</option>                                    @foreach ($aseguradoras as $a)                                    <option value="{{ $a->id }}" @selected(old('aseguradora_id') == $a->id)>{{ $a->nombre }}</option>                                    @endforeach                                </select>                                @error('aseguradora_id') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror                            </div>
</div>
</div>
</div>
<div class="card">
<div class="card-header">
<h3>Ubicación y Ruta</h3>
</div>
<div class="card-body">
<div class="form-grid">
<div class="form-group">
<label>Origen</label>
<input type="text" name="origen_direccion" value="{{ old('origen_direccion') }}" placeholder="Av. Reforma 123, Col. Centro" required>                                @error('origen_direccion') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror                            </div>
<div class="form-group">
<label>Latitud origen</label>
<input type="text" name="origen_lat" value="{{ old('origen_lat') }}" placeholder="19.432608" step="any">
</div>
<div class="form-group">
<label>Longitud origen</label>
<input type="text" name="origen_lng" value="{{ old('origen_lng') }}" placeholder="-99.133209" step="any">
</div>
<div class="form-group">
<label>Destino</label>
<input type="text" name="destino_direccion" value="{{ old('destino_direccion') }}" placeholder="Periférico 456, Col. Granada" required>                                @error('destino_direccion') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror                            </div>
<div class="form-group">
<label>Latitud destino</label>
<input type="text" name="destino_lat" value="{{ old('destino_lat') }}" placeholder="19.432608" step="any">
</div>
<div class="form-group">
<label>Longitud destino</label>
<input type="text" name="destino_lng" value="{{ old('destino_lng') }}" placeholder="-99.133209" step="any">
</div>
<div class="form-group">
<label>Tipo de servicio</label>
<select name="tipo_servicio_id" required>
<option value="">Seleccionar...</option>                                    @foreach ($tiposServicio as $ts)                                    <option value="{{ $ts->id }}" @selected(old('tipo_servicio_id') == $ts->id)>{{ $ts->nombre }}</option>                                    @endforeach                                </select>                                @error('tipo_servicio_id') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror                            </div>
</div>
<div class="map-placeholder mt-3 h-40">
<div class="map-grid">
</div>
<div class="map-content absolute inset-0 flex flex-col items-center justify-center">
<div class="text-3xl mb-2">📍</div>
<div class="font-semibold text-gray-600">Mapa de ruta</div>
<div class="text-xs text-gray-500" x-text="origen_direccion && destino_direccion ? `${origen_direccion} → ${destino_direccion} (${distancia_km} km)` : 'Ingresa origen y destino'">
</div>
</div>
</div>
<div class="form-grid mt-4">
<div class="form-group">
<label>Distancia (km)</label>
<input type="number" step="0.1" name="distancia_km" x-model="distancia_km" placeholder="12.5" required>
</div>
<div class="form-group">
<label>Tiempo estimado (min)</label>
<input type="number" name="tiempo_estimado_minutos" x-model="tiempo_estimado_minutos" placeholder="25" required>
</div>
</div>
<div class="mt-3 flex flex-col gap-3">
<div class="route-card" :class="{ 'selected': !incluye_peajes }" @@click="incluye_peajes = false; costo_aprox_casetas = 0">
<div>
<div class="route-title">Ruta 1 — Sin peaje</div>
<div class="route-meta">
<span>📍 <span x-text="distancia_km || 0">
</span> km</span>
<span>⏱ <span x-text="tiempo_estimado_minutos || 0">
</span> min</span>
</div>
</div>
<div class="route-price" x-text="'$' + formatPrice(sinPeajeTotal())">
</div>
</div>
<div class="route-card" :class="{ 'selected': incluye_peajes }" @@click="incluye_peajes = true">
<div>
<div class="route-title">Ruta 2 — Con peaje</div>
<div class="route-meta">
<span>📍 <span x-text="distancia_km || 0">
</span> km</span>
<span>⏱ <span x-text="tiempo_estimado_minutos || 0">
</span> min</span>
</div>
<div class="mt-2 flex items-center gap-2">
<span class="text-xs text-gray-500">Costo aprox. casetas:</span>
<input type="number" class="w-24 px-2 py-0.5 text-xs border rounded" step="1" x-model.number="costo_aprox_casetas" @@click.stop>
</div>
</div>
<div class="route-price" x-text="'$' + formatPrice(conPeajeTotal())">
</div>
</div>
<input type="hidden" name="incluye_peajes" x-bind:value="incluye_peajes">
<input type="hidden" name="costo_aprox_casetas" x-bind:value="costo_aprox_casetas">
</div>
</div>
</div>
<div class="form-actions">
<a href="{{ route('cotizaciones.index') }}" class="btn btn-secondary">Cancelar</a>
<button type="submit" class="btn btn-primary">Generar cotización</button>
</div>
</div>
<div class="space-y-5">
<div class="card">
<div class="card-header">
<h3>Resumen de costos</h3>
</div>
<div class="card-body">
<div class="cost-summary">
<div class="cost-row">
<span>Banderazo</span>
<span x-text="'$' + formatPrice(costo_banderazo)">
</span>
</div>
<div class="cost-row">
<span>Kilometraje (<span x-text="distancia_km || 0">
</span> km × <span x-text="costo_km">
</span>/km)</span>
<span x-text="'$' + formatPrice(costoKilometraje())">
</span>
</div>
<div class="cost-row" x-show="costo_aprox_casetas > 0">
<span>Casetas</span>
<span x-text="'$' + formatPrice(costo_aprox_casetas)">
</span>
</div>
<div class="cost-row total">
<span>Total estimado</span>
<span x-text="'$' + formatPrice(total())">
</span>
</div>
</div>
</div>
</div>
<div class="card">
<div class="card-header">
<h3>Convenio aplicable</h3>
</div>
<div class="card-body">                        @if ($convenios->count())                        <div class="form-group">
<select name="convenio_aplicado_id" x-model="convenio_aplicado_id" @@change="actualizarConvenio()">
<option value="">Sin convenio</option>                                @foreach ($convenios as $c)                                <option value="{{ $c->id }}"                                    data-descuento="{{ $c->descuento }}">                                    {{ $c->nombre }} ({{ $c->descuento }}% descuento)                                </option>                                @endforeach                            </select>
</div>
<template x-if="convenio_aplicado_id">
<div class="flex items-center gap-3 p-3 rounded-lg border" style="background: #f0fdf4; border-color: #bbf7d0;">
<div class="text-2xl">✅</div>
<div>
<div class="font-semibold text-sm" x-text="convenioNombre">
</div>
<div class="text-xs text-gray-500" x-text="'Descuento: ' + descuento_porcentaje + '%'">
</div>
</div>
</div>
</template>                        @else                        <p class="text-sm text-gray-500">No hay convenios activos.</p>                        @endif                    </div>
</div>
</div>
</div>
</form>
</div>
@endsection

@push('scripts')
<script>function cotizacionForm() {    return {        destino_direccion: '{{ old('destino_direccion') }}',        origen_direccion: '{{ old('origen_direccion') }}',        distancia_km: {{ old('distancia_km', 0) }},        tiempo_estimado_minutos: {{ old('tiempo_estimado_minutos', 0) }},        incluye_peajes: {{ old('incluye_peajes', false) ? 'true' : 'false' }},        costo_aprox_casetas: {{ old('costo_aprox_casetas', 0) }},        costo_banderazo: 500,        costo_km: 120,        convenio_aplicado_id: '{{ old('convenio_aplicado_id') }}',        descuento_porcentaje: 0,        convenioNombre: '',        formatPrice(v) { return v.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',') },        costoKilometraje() { return (this.distancia_km || 0) * this.costo_km },        sinPeajeTotal() { return this.costo_banderazo + this.costoKilometraje() },        conPeajeTotal() { return this.costo_banderazo + this.costoKilometraje() + (this.costo_aprox_casetas || 0) },        total() { return this.costo_banderazo + this.costoKilometraje() + (this.costo_aprox_casetas || 0) },        actualizarConvenio() {            const sel = document.querySelector('[name="convenio_aplicado_id"]');            const opt = sel.options[sel.selectedIndex];            if (opt && opt.value) {                this.descuento_porcentaje = parseFloat(opt.dataset.descuento) || 0;                this.convenioNombre = opt.text;            } else {                this.descuento_porcentaje = 0;                this.convenioNombre = '';            }        }    }
</script>
@endpush