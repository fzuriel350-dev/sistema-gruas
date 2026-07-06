@extends('layouts.app')@section('title', 'Nuevo Servicio Configurado')@section('content')<div class="max-w-2xl mx-auto">
<div class="card">
<div class="card-header">
<h3>Nuevo Servicio Configurado</h3>
<a href="{{ route('servicios-configurados.index') }}" class="btn btn-sm btn-ghost">Volver</a>
</div>
<div class="card-body">
<form method="POST" action="{{ route('servicios-configurados.store') }}" class="form-grid">                @csrf                <div class="form-group">
<label for="nombre">Nombre del servicio</label>
<input id="nombre" name="nombre" type="text" value="{{ old('nombre') }}" required>
<x-input-error :messages="$errors->get('nombre')" />
</div>
<div class="form-group">
<label for="cliente_id">Cliente</label>
<select id="cliente_id" name="cliente_id" required>
<option value="">Seleccionar cliente</option>                        @foreach ($clientes as $c)                            <option value="{{ $c->id }}" @selected(old('cliente_id') == $c->id)>{{ $c->nombre }}</option>                        @endforeach                    </select>
<x-input-error :messages="$errors->get('cliente_id')" />
</div>
<div class="form-group">
<label for="tipo_servicio_id">Tipo de Servicio</label>
<select id="tipo_servicio_id" name="tipo_servicio_id" required>
<option value="">Seleccionar tipo</option>                        @foreach ($tipos as $t)                            <option value="{{ $t->id }}" @selected(old('tipo_servicio_id') == $t->id)>{{ $t->nombre }}</option>                        @endforeach                    </select>
<x-input-error :messages="$errors->get('tipo_servicio_id')" />
</div>
<div class="form-group">
<label for="tipo">Tipo</label>
<select id="tipo" name="tipo" required>
<option value="publico" @selected(old('tipo') === 'publico')>Público</option>
<option value="aseguradora" @selected(old('tipo') === 'aseguradora')>Aseguradora</option>
<option value="particular" @selected(old('tipo') === 'particular')>Particular</option>
</select>
<x-input-error :messages="$errors->get('tipo')" />
</div>
<div class="grid grid-cols-2 gap-3">
<div class="form-group">
<label for="costo_banderazo">Costo Banderazo ($)</label>
<input id="costo_banderazo" name="costo_banderazo" type="number" step="0.01" min="0" value="{{ old('costo_banderazo') }}" required>
<x-input-error :messages="$errors->get('costo_banderazo')" />
</div>
<div class="form-group">
<label for="costo_km">Costo por Km ($)</label>
<input id="costo_km" name="costo_km" type="number" step="0.01" min="0" value="{{ old('costo_km') }}" required>
<x-input-error :messages="$errors->get('costo_km')" />
</div>
</div>
<div class="form-group">
<label class="flex items-center gap-3 cursor-pointer">
<input type="checkbox" name="activo" value="1" @checked(old('activo', true)) class="w-4 h-4 rounded border-gray-300 text-[#FFD500] focus:ring-[#FFD500]">
<span class="text-sm font-medium">Servicio activo</span>
</label>
</div>
<div class="form-group">
<label for="observaciones">Observaciones (opcional)</label>
<textarea id="observaciones" name="observaciones" rows="3">{{ old('observaciones') }}</textarea>
<x-input-error :messages="$errors->get('observaciones')" />
</div>
<div class="flex items-center gap-3 pt-2">
<button type="submit" class="btn btn-primary">Guardar</button>
<a href="{{ route('servicios-configurados.index') }}" class="btn btn-ghost">Cancelar</a>
</div>
</form>
</div>
</div>
</div>@endsection
