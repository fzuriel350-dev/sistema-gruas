@extends('layouts.app')@section('title', 'Nueva Nómina')@section('content')<div class="max-w-2xl mx-auto">
<div class="card">
<div class="card-header">
<h3>Nueva Nómina</h3>
<a href="{{ route('control-nomina.index') }}" class="btn btn-sm btn-ghost">Volver</a>
</div>
<div class="card-body">
<form method="POST" action="{{ route('control-nomina.store') }}" class="form-grid">                @csrf                <div class="form-group">
<label for="operador_id">Operador</label>
<select id="operador_id" name="operador_id" required>
<option value="">Seleccionar operador</option>                        @foreach ($operadores as $o)                            <option value="{{ $o->id }}" @selected(old('operador_id') == $o->id)>{{ $o->empleado?->nombre ?? 'Operador #' . $o->id }}</option>                        @endforeach                    </select>
<x-input-error :messages="$errors->get('operador_id')" />
</div>
<div class="grid grid-cols-2 gap-3">
<div class="form-group">
<label for="fecha_desde">Fecha desde</label>
<input id="fecha_desde" name="fecha_desde" type="date" value="{{ old('fecha_desde') }}" required>
<x-input-error :messages="$errors->get('fecha_desde')" />
</div>
<div class="form-group">
<label for="fecha_hasta">Fecha hasta</label>
<input id="fecha_hasta" name="fecha_hasta" type="date" value="{{ old('fecha_hasta') }}" required>
<x-input-error :messages="$errors->get('fecha_hasta')" />
</div>
</div>
<div class="form-group">
<label for="sueldo_base_semanal">Sueldo Base Semanal ($)</label>
<input id="sueldo_base_semanal" name="sueldo_base_semanal" type="number" step="0.01" min="0" value="{{ old('sueldo_base_semanal') }}" required>
<x-input-error :messages="$errors->get('sueldo_base_semanal')" />
</div>
<div class="grid grid-cols-2 gap-3">
<div class="form-group">
<label for="bonos_servicios">Bonos por Servicios ($)</label>
<input id="bonos_servicios" name="bonos_servicios" type="number" step="0.01" min="0" value="{{ old('bonos_servicios', '0') }}">
<x-input-error :messages="$errors->get('bonos_servicios')" />
</div>
<div class="form-group">
<label for="descuentos_prestamos">Descuentos / Préstamos ($)</label>
<input id="descuentos_prestamos" name="descuentos_prestamos" type="number" step="0.01" min="0" value="{{ old('descuentos_prestamos', '0') }}">
<x-input-error :messages="$errors->get('descuentos_prestamos')" />
</div>
</div>
<div class="form-group">
<label for="total_neto_a_pagar">Total Neto a Pagar ($)</label>
<input id="total_neto_a_pagar" name="total_neto_a_pagar" type="number" step="0.01" min="0" value="{{ old('total_neto_a_pagar') }}" required>
<x-input-error :messages="$errors->get('total_neto_a_pagar')" />
</div>
<div class="form-group">
<label for="estatus">Estatus</label>
<select id="estatus" name="estatus" required>
<option value="pendiente" @selected(old('estatus') === 'pendiente')>Pendiente</option>
<option value="pagado" @selected(old('estatus') === 'pagado')>Pagado</option>
</select>
<x-input-error :messages="$errors->get('estatus')" />
</div>
<div class="flex items-center gap-3 pt-2">
<button type="submit" class="btn btn-primary">Guardar</button>
<a href="{{ route('control-nomina.index') }}" class="btn btn-ghost">Cancelar</a>
</div>
</form>
</div>
</div>
</div>@endsection
