@extends('layouts.app')@section('title', 'Nuevo Cliente')@section('content')<div class="max-w-2xl mx-auto">
<div class="card">
<div class="card-header">
<h3>Nuevo Cliente</h3>
<a href="{{ route('clientes.index') }}" class="btn btn-sm btn-ghost">Volver</a>
</div>
<div class="card-body">
<form method="POST" action="{{ route('clientes.store') }}" class="form-grid">                @csrf                <div class="form-group">
<label for="nombre">Nombre</label>
<input id="nombre" name="nombre" type="text" value="{{ old('nombre') }}" required>
<x-input-error :messages="$errors->get('nombre')" />
</div>
<div class="form-group">
<label for="empresa">Empresa</label>
<input id="empresa" name="empresa" type="text" value="{{ old('empresa') }}">
<x-input-error :messages="$errors->get('empresa')" />
</div>
<div class="form-group">
<label for="telefono">Teléfono</label>
<input id="telefono" name="telefono" type="text" value="{{ old('telefono') }}">
<x-input-error :messages="$errors->get('telefono')" />
</div>
<div class="form-group">
<label for="email">Email</label>
<input id="email" name="email" type="email" value="{{ old('email') }}">
<x-input-error :messages="$errors->get('email')" />
</div>
<div class="form-group">
<label for="aseguradora_id">Aseguradora</label>
<select id="aseguradora_id" name="aseguradora_id">
<option value="">Seleccionar...</option>                        @foreach ($aseguradoras as $a)                            <option value="{{ $a->id }}" @selected(old('aseguradora_id') == $a->id)>{{ $a->nombre }}</option>                        @endforeach                    </select>
<x-input-error :messages="$errors->get('aseguradora_id')" />
</div>
<div class="form-group">
<label for="numero_poliza">Número de Póliza</label>
<input id="numero_poliza" name="numero_poliza" type="text" value="{{ old('numero_poliza') }}">
<x-input-error :messages="$errors->get('numero_poliza')" />
</div>
<div class="form-group">
<label for="tipo_cobertura_poliza">Tipo de Cobertura</label>
<input id="tipo_cobertura_poliza" name="tipo_cobertura_poliza" type="text" value="{{ old('tipo_cobertura_poliza') }}">
<x-input-error :messages="$errors->get('tipo_cobertura_poliza')" />
</div>
<div class="form-group">
<label for="contacto">Contacto</label>
<input id="contacto" name="contacto" type="text" value="{{ old('contacto') }}">
<x-input-error :messages="$errors->get('contacto')" />
</div>
<div class="form-group">
<label for="direccion">Dirección</label>
<textarea id="direccion" name="direccion" rows="3">{{ old('direccion') }}</textarea>
<x-input-error :messages="$errors->get('direccion')" />
</div>
<div class="flex items-center gap-3 pt-2">
<button type="submit" class="btn btn-primary">Guardar</button>
<a href="{{ route('clientes.index') }}" class="btn btn-ghost">Cancelar</a>
</div>
</form>
</div>
</div>
</div>@endsection
