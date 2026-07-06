@extends('layouts.app')@section('title', 'Editar Oficina')@section('content')<div class="max-w-2xl mx-auto">
<div class="card">
<div class="card-header">
<h3>Editar Oficina</h3>
<a href="{{ route('oficinas.index') }}" class="btn btn-sm btn-ghost">Volver</a>
</div>
<div class="card-body">
<form method="POST" action="{{ route('oficinas.update', $oficina) }}" class="form-grid">                @csrf @method('PUT')                <div class="form-group">
<label for="nombre">Nombre</label>
<input id="nombre" name="nombre" type="text" value="{{ old('nombre', $oficina->nombre) }}" required>
<x-input-error :messages="$errors->get('nombre')" />
</div>
<div class="form-group">
<label for="direccion">Dirección</label>
<textarea id="direccion" name="direccion" rows="2">{{ old('direccion', $oficina->direccion) }}</textarea>
<x-input-error :messages="$errors->get('direccion')" />
</div>
<div class="form-group">
<label for="ciudad">Ciudad</label>
<input id="ciudad" name="ciudad" type="text" value="{{ old('ciudad', $oficina->ciudad) }}">
<x-input-error :messages="$errors->get('ciudad')" />
</div>
<div class="form-group">
<label for="estado">Estado</label>
<input id="estado" name="estado" type="text" value="{{ old('estado', $oficina->estado) }}">
<x-input-error :messages="$errors->get('estado')" />
</div>
<div class="form-group">
<label for="telefono">Teléfono</label>
<input id="telefono" name="telefono" type="text" value="{{ old('telefono', $oficina->telefono) }}">
<x-input-error :messages="$errors->get('telefono')" />
</div>
<div class="form-group">
<label for="encargado">Encargado</label>
<input id="encargado" name="encargado" type="text" value="{{ old('encargado', $oficina->encargado) }}">
<x-input-error :messages="$errors->get('encargado')" />
</div>
<div class="flex items-center gap-3 pt-2">
<button type="submit" class="btn btn-primary">Actualizar</button>
<a href="{{ route('oficinas.index') }}" class="btn btn-ghost">Cancelar</a>
</div>
</form>
</div>
</div>
</div>@endsection
