@extends('layouts.app')@section('title', 'Editar Unidad')@section('content')<div class="max-w-2xl mx-auto">
<div class="card">
<div class="card-header">
<h3>Editar Unidad</h3>
<a href="{{ route('unidades.index') }}" class="btn btn-sm btn-ghost">Volver</a>
</div>
<div class="card-body">
<form method="POST" action="{{ route('unidades.update', $unidad) }}" class="form-grid">                @csrf @method('PUT')                <div class="form-group">
<label for="marca" >Marca</label>
<input id="marca" name="marca" type="text" value="{{ old('marca', $unidad->marca) }}" required>
<x-input-error :messages="$errors->get('marca')" />
</div>
<div class="form-group">
<label for="tipo" >Tipo</label>
<input id="tipo" name="tipo" type="text" value="{{ old('tipo', $unidad->tipo) }}" required>
<x-input-error :messages="$errors->get('tipo')" />
</div>
<div class="form-group">
<label for="modelo" >Modelo</label>
<input id="modelo" name="modelo" type="text" value="{{ old('modelo', $unidad->modelo) }}">
<x-input-error :messages="$errors->get('modelo')" />
</div>
<div class="form-group">
<label for="año" >Año</label>
<input id="año" name="año" type="number" value="{{ old('año', $unidad->año) }}" required>
<x-input-error :messages="$errors->get('año')" />
</div>
<div class="form-group">
<label for="placas" >Placas</label>
<input id="placas" name="placas" type="text" value="{{ old('placas', $unidad->placas) }}" required>
<x-input-error :messages="$errors->get('placas')" />
</div>
<div class="form-group">
<label for="numero_economico" >Número Económico</label>
<input id="numero_economico" name="numero_economico" type="text" value="{{ old('numero_economico', $unidad->numero_economico) }}">
<x-input-error :messages="$errors->get('numero_economico')" />
</div>
<div class="form-group">
<label for="numero_serie" >Número de Serie (VIN)</label>
<input id="numero_serie" name="numero_serie" type="text" value="{{ old('numero_serie', $unidad->numero_serie) }}">
<x-input-error :messages="$errors->get('numero_serie')" />
</div>
<div class="form-group">
<label for="estado_emplacado" >Estado Emplacado</label>
<input id="estado_emplacado" name="estado_emplacado" type="text" value="{{ old('estado_emplacado', $unidad->estado_emplacado) }}">
<x-input-error :messages="$errors->get('estado_emplacado')" />
</div>
<div class="form-group">
<label for="seguro_vencimiento" >Vencimiento del Seguro</label>
<input id="seguro_vencimiento" name="seguro_vencimiento" type="date" value="{{ old('seguro_vencimiento', $unidad->seguro_vencimiento?->format('Y-m-d')) }}">
<x-input-error :messages="$errors->get('seguro_vencimiento')" />
</div>
<div class="form-group">
<label for="oficina_id" >Oficina</label>
<select id="oficina_id" name="oficina_id">
<option value="">Seleccionar...</option>                        @foreach ($oficinas as $oficina)                            <option value="{{ $oficina->id }}" @selected(old('oficina_id', $unidad->oficina_id) == $oficina->id)>{{ $oficina->nombre }}</option>                        @endforeach                    </select>
<x-input-error :messages="$errors->get('oficina_id')" />
</div>
<div class="form-group">
<label for="operador_id" >Operador Asignado</label>
<select id="operador_id" name="operador_id" >
<option value="">Sin asignar</option>                        @foreach ($operadores as $op)                            <option value="{{ $op->id }}" @selected(old('operador_id', $unidad->operador_id) == $op->id)>{{ $op->empleado?->nombreCompleto() }}</option>                        @endforeach                    </select>
<x-input-error :messages="$errors->get('operador_id')" />
</div>
<div class="form-group">
<label class="flex items-center gap-2">
<input type="checkbox" name="activo" value="1" @checked(old('activo', $unidad->activo)) class="rounded border-gray-300">
<span class="text-sm font-medium text-gray-700">Unidad activa</span>
</label>
</div>
<div class="flex items-center gap-3 pt-2">
<button type="submit" class="btn btn-primary">Actualizar</button>
<a href="{{ route('unidades.index') }}" class="btn btn-ghost">Cancelar</a>
</div>
</form>
</div>
</div>
</div>@endsection
