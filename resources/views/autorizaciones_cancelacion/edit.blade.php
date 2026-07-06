@extends('layouts.app')@section('title', 'Resolver Solicitud')@section('content')<div class="max-w-2xl mx-auto">
<div class="card">
<div class="card-header">
<h3>Resolver Solicitud de Cancelación</h3>
<a href="{{ route('autorizaciones-cancelacion.index') }}" class="btn btn-sm btn-ghost">Volver</a>
</div>
<div class="card-body">
<div class="mb-5 p-4 rounded-lg bg-gray-50 text-sm">
<p><strong>Servicio:</strong> #{{ $autorizacionCancelacion->servicio?->id }}</p>
<p><strong>Solicitante:</strong> {{ $autorizacionCancelacion->usuarioSolicitante?->name }}</p>
<p><strong>Motivo:</strong> {{ $autorizacionCancelacion->motivo_cancelacion }}</p>
</div>
<form method="POST" action="{{ route('autorizaciones-cancelacion.update', $autorizacionCancelacion) }}" class="form-grid">                @csrf @method('PUT')                <div class="form-group">
<label for="estatus">Decisión</label>
<select id="estatus" name="estatus" required>
<option value="">Seleccionar...</option>                        @foreach (App\Models\AutorizacionCancelacion::ESTATUS as $e)                            <option value="{{ $e }}" @selected(old('estatus', $autorizacionCancelacion->estatus) == $e)>{{ str_replace('_', ' ', ucfirst($e)) }}</option>                        @endforeach                    </select>
<x-input-error :messages="$errors->get('estatus')" />
</div>
<div class="flex items-center gap-3 pt-2">
<button type="submit" class="btn btn-primary">Guardar</button>
<a href="{{ route('autorizaciones-cancelacion.index') }}" class="btn btn-ghost">Cancelar</a>
</div>
</form>
</div>
</div>
</div>@endsection
