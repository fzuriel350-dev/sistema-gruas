@extends('layouts.app')@section('title', 'Nueva Carga de Diesel')@section('content')<div class="max-w-2xl mx-auto">
<div class="card">
<div class="card-header">
<h3>Nueva Carga de Diesel</h3>
<a href="{{ route('cargas-diesel.index') }}" class="btn btn-sm btn-ghost">Volver</a>
</div>
<div class="card-body">
<form method="POST" action="{{ route('cargas-diesel.store') }}" class="form-grid">                @csrf                <div class="form-group">
<label for="unidad_id">Unidad</label>
<select id="unidad_id" name="unidad_id" required>
<option value="">Seleccionar unidad</option>                        @foreach ($unidades as $u)                            <option value="{{ $u->id }}" @selected(old('unidad_id') == $u->id)>{{ $u->marca }} — {{ $u->placas }}</option>                        @endforeach                    </select>
<x-input-error :messages="$errors->get('unidad_id')" />
</div>
<div class="form-group">
<label for="operador_id">Operador</label>
<select id="operador_id" name="operador_id" required>
<option value="">Seleccionar operador</option>                        @foreach ($operadores as $op)                            <option value="{{ $op->id }}" @selected(old('operador_id') == $op->id)>{{ $op->empleado?->nombreCompleto() }}</option>                        @endforeach                    </select>
<x-input-error :messages="$errors->get('operador_id')" />
</div>
<div class="form-group">
<label for="litros">Litros</label>
<input id="litros" name="litros" type="number" step="0.01" min="0" value="{{ old('litros') }}" required>
<x-input-error :messages="$errors->get('litros')" />
</div>
<div class="form-group">
<label for="costo_litro">Costo por Litro ($)</label>
<input id="costo_litro" name="costo_litro" type="number" step="0.01" min="0" value="{{ old('costo_litro') }}" required>
<x-input-error :messages="$errors->get('costo_litro')" />
</div>
<div class="form-group">
<label for="km_actual">Kilometraje Actual</label>
<input id="km_actual" name="km_actual" type="number" min="0" value="{{ old('km_actual') }}" required>
<x-input-error :messages="$errors->get('km_actual')" />
</div>
<div class="form-group">
<label for="fecha_carga">Fecha de Carga</label>
<input id="fecha_carga" name="fecha_carga" type="datetime-local" value="{{ old('fecha_carga') }}" required>
<x-input-error :messages="$errors->get('fecha_carga')" />
</div>
<div class="form-group">
<label for="observaciones">Observaciones</label>
<textarea id="observaciones" name="observaciones" rows="2">{{ old('observaciones') }}</textarea>
<x-input-error :messages="$errors->get('observaciones')" />
</div>
<div class="flex items-center gap-3 pt-2">
<button type="submit" class="btn btn-primary">Guardar</button>
<a href="{{ route('cargas-diesel.index') }}" class="btn btn-ghost">Cancelar</a>
</div>
</form>
</div>
</div>
</div>@endsection
