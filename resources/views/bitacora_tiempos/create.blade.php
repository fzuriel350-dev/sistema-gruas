@extends('layouts.app')@section('title', 'Nueva Bitácora de Tiempos')@section('content')<div class="max-w-2xl mx-auto">
<div class="card">
<div class="card-header">
<h3>Nueva Bitácora de Tiempos</h3>
<a href="{{ route('bitacora-tiempos.index') }}" class="btn btn-sm btn-ghost">Volver</a>
</div>
<div class="card-body">
<form method="POST" action="{{ route('bitacora-tiempos.store') }}" class="form-grid">                @csrf                <div class="form-group">
<label for="servicio_id">Servicio</label>
<select id="servicio_id" name="servicio_id" required>
<option value="">Seleccionar servicio</option>                        @foreach ($servicios as $s)                            <option value="{{ $s->id }}" @selected(old('servicio_id') == $s->id)>{{ $s->cotizacion?->folio ?? '#' . $s->id }}</option>                        @endforeach                    </select>
<x-input-error :messages="$errors->get('servicio_id')" />
</div>
<div class="form-group">
<label for="hora_asignado">Hora de Asignación</label>
<input id="hora_asignado" name="hora_asignado" type="datetime-local" value="{{ old('hora_asignado') }}">
<x-input-error :messages="$errors->get('hora_asignado')" />
</div>
<div class="form-group">
<label for="hora_inicio_servicio">Hora de Inicio de Servicio</label>
<input id="hora_inicio_servicio" name="hora_inicio_servicio" type="datetime-local" value="{{ old('hora_inicio_servicio') }}">
<x-input-error :messages="$errors->get('hora_inicio_servicio')" />
</div>
<div class="form-group">
<label for="hora_en_sitio_origen">Hora en Sitio (Origen)</label>
<input id="hora_en_sitio_origen" name="hora_en_sitio_origen" type="datetime-local" value="{{ old('hora_en_sitio_origen') }}">
<x-input-error :messages="$errors->get('hora_en_sitio_origen')" />
</div>
<div class="form-group">
<label for="hora_salida_destino">Hora Salida a Destino</label>
<input id="hora_salida_destino" name="hora_salida_destino" type="datetime-local" value="{{ old('hora_salida_destino') }}">
<x-input-error :messages="$errors->get('hora_salida_destino')" />
</div>
<div class="form-group">
<label for="hora_en_destino">Hora en Destino</label>
<input id="hora_en_destino" name="hora_en_destino" type="datetime-local" value="{{ old('hora_en_destino') }}">
<x-input-error :messages="$errors->get('hora_en_destino')" />
</div>
<div class="form-group">
<label for="hora_finalizado">Hora Finalizado</label>
<input id="hora_finalizado" name="hora_finalizado" type="datetime-local" value="{{ old('hora_finalizado') }}">
<x-input-error :messages="$errors->get('hora_finalizado')" />
</div>
<div class="flex items-center gap-3 pt-2">
<button type="submit" class="btn btn-primary">Guardar</button>
<a href="{{ route('bitacora-tiempos.index') }}" class="btn btn-ghost">Cancelar</a>
</div>
</form>
</div>
</div>
</div>@endsection
