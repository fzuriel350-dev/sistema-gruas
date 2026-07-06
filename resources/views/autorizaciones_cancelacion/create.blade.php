@extends('layouts.app')@section('title', 'Nueva Solicitud de Cancelación')@section('content')<div class="max-w-2xl mx-auto">
<div class="card">
<div class="card-header">
<h3>Nueva Solicitud de Cancelación</h3>
<a href="{{ route('autorizaciones-cancelacion.index') }}" class="btn btn-sm btn-ghost">Volver</a>
</div>
<div class="card-body">
<form method="POST" action="{{ route('autorizaciones-cancelacion.store') }}" class="form-grid">                @csrf                <div class="form-group">
<label for="servicio_id">Servicio</label>
<select id="servicio_id" name="servicio_id" required>
<option value="">Seleccionar servicio</option>                        @foreach ($servicios as $s)                            <option value="{{ $s->id }}" @selected(old('servicio_id') == $s->id)>{{ '#' . $s->id . ' — ' . ($s->cotizacion?->folio ?? 'Sin folio') }}</option>                        @endforeach                    </select>
<x-input-error :messages="$errors->get('servicio_id')" />
</div>
<div class="form-group">
<label for="tipo_incidencia">Tipo de Incidencia</label>
<select id="tipo_incidencia" name="tipo_incidencia" required>
<option value="">Seleccionar tipo</option>                        @foreach (App\Models\AutorizacionCancelacion::TIPOS_INCIDENCIA as $t)                            <option value="{{ $t }}" @selected(old('tipo_incidencia') == $t)>{{ str_replace('_', ' ', ucfirst($t)) }}</option>                        @endforeach                    </select>
<x-input-error :messages="$errors->get('tipo_incidencia')" />
</div>
<div class="form-group">
<label for="motivo_cancelacion">Motivo de Cancelación</label>
<textarea id="motivo_cancelacion" name="motivo_cancelacion" rows="4" required>{{ old('motivo_cancelacion') }}</textarea>
<x-input-error :messages="$errors->get('motivo_cancelacion')" />
</div>
<div class="flex items-center gap-3 pt-2">
<button type="submit" class="btn btn-primary">Registrar Solicitud</button>
<a href="{{ route('autorizaciones-cancelacion.index') }}" class="btn btn-ghost">Cancelar</a>
</div>
</form>
</div>
</div>
</div>@endsection
