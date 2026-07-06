@extends('layouts.app')@section('title', 'Nuevo Empleado')@section('content')<div class="max-w-2xl mx-auto">
<div class="card">
<div class="card-header">
<h3>Nuevo Empleado</h3>
<a href="{{ route('empleados.index') }}" class="btn btn-sm btn-ghost">Volver</a>
</div>
<div class="card-body">
<form method="POST" action="{{ route('empleados.store') }}" class="form-grid">                @csrf                <div class="form-group">
<label for="nombre" >Nombre(s)</label>
<input id="nombre" name="nombre" type="text" value="{{ old('nombre') }}" required>
<x-input-error :messages="$errors->get('nombre')" />
</div>
<div class="form-group">
<label for="apellido_paterno" >Apellido Paterno</label>
<input id="apellido_paterno" name="apellido_paterno" type="text" value="{{ old('apellido_paterno') }}" required>
<x-input-error :messages="$errors->get('apellido_paterno')" />
</div>
<div class="form-group">
<label for="apellido_materno" >Apellido Materno</label>
<input id="apellido_materno" name="apellido_materno" type="text" value="{{ old('apellido_materno') }}">
<x-input-error :messages="$errors->get('apellido_materno')" />
</div>
<div class="form-group">
<label for="telefono" >Teléfono</label>
<input id="telefono" name="telefono" type="text" value="{{ old('telefono') }}">
<x-input-error :messages="$errors->get('telefono')" />
</div>
<div class="form-group">
<label for="direccion" >Dirección</label>
<textarea id="direccion" name="direccion" rows="2">{{ old('direccion') }}</textarea>
<x-input-error :messages="$errors->get('direccion')" />
</div>
<div class="form-group">
<label for="oficina_id" >Oficina</label>
<select id="oficina_id" name="oficina_id">
<option value="">Seleccionar...</option>
@foreach ($oficinas as $oficina)
<option value="{{ $oficina->id }}" @selected(old('oficina_id') == $oficina->id)>{{ $oficina->nombre }}</option>
@endforeach
</select>
<x-input-error :messages="$errors->get('oficina_id')" />
</div>
<div class="form-group">
<label for="puesto" >Puesto</label>
<input id="puesto" name="puesto" type="text" value="{{ old('puesto') }}">
<x-input-error :messages="$errors->get('puesto')" />
</div>
<div class="form-group">
<label for="sueldo_diario" >Sueldo diario</label>
<input id="sueldo_diario" name="sueldo_diario" type="number" step="0.01" min="0" value="{{ old('sueldo_diario') }}">
<x-input-error :messages="$errors->get('sueldo_diario')" />
</div>
<div class="form-group">
<label for="role" >Rol</label>
<select id="role" name="role" required>
<option value="">Seleccionar...</option>
<option value="admin" @selected(old('role') === 'admin')>Admin</option>
<option value="cotizador" @selected(old('role') === 'cotizador')>Cotizador</option>
<option value="operador" @selected(old('role') === 'operador')>Operador</option>
</select>
<x-input-error :messages="$errors->get('role')" />
</div>
<hr class="border-gray-200 my-2">
<p class="text-sm text-gray-500 font-medium">Datos de acceso</p>
<div class="form-group">
<label for="email" >Email</label>
<input id="email" name="email" type="email" value="{{ old('email') }}" required>
<x-input-error :messages="$errors->get('email')" />
</div>
<div class="form-group">
<label for="password" >Contraseña</label>
<input id="password" name="password" type="password" required>
<x-input-error :messages="$errors->get('password')" />
</div>
<div class="form-group">
<label for="password_confirmation" >Confirmar Contraseña</label>
<input id="password_confirmation" name="password_confirmation" type="password" required>
<x-input-error :messages="$errors->get('password_confirmation')" />
</div>
<div class="flex items-center gap-3 pt-2">
<button type="submit" class="btn btn-primary">Guardar</button>
<a href="{{ route('empleados.index') }}" class="btn btn-ghost">Cancelar</a>
</div>
</form>
</div>
</div>
</div>@endsection
