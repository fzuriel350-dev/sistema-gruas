@extends('layouts.app')@section('title', 'Editar Factura')@section('content')<div class="max-w-2xl mx-auto">
<div class="card">
<div class="card-header">
<h3>Editar Factura</h3>
<a href="{{ route('facturas.index') }}" class="btn btn-sm btn-ghost">Volver</a>
</div>
<div class="card-body">
<form method="POST" action="{{ route('facturas.update', $factura) }}" class="form-grid">                @csrf @method('PUT')                <div class="form-group">
<label for="folio_factura">Folio de Factura</label>
<input id="folio_factura" name="folio_factura" type="text" value="{{ old('folio_factura', $factura->folio_factura) }}" required>
<x-input-error :messages="$errors->get('folio_factura')" />
</div>
<div class="form-group">
<label for="cliente_id">Cliente</label>
<select id="cliente_id" name="cliente_id" required>
<option value="">Seleccionar cliente</option>                        @foreach ($clientes as $c)                            <option value="{{ $c->id }}" @selected(old('cliente_id', $factura->cliente_id) == $c->id)>{{ $c->nombre }}</option>                        @endforeach                    </select>
<x-input-error :messages="$errors->get('cliente_id')" />
</div>
<div class="form-group">
<label for="servicio_id">Servicio</label>
<select id="servicio_id" name="servicio_id" required>
<option value="">Seleccionar servicio</option>                        @foreach ($servicios as $s)                            <option value="{{ $s->id }}" @selected(old('servicio_id', $factura->servicio_id) == $s->id)>{{ '#' . $s->id . ' — ' . ($s->cotizacion?->folio ?? '') }}</option>                        @endforeach                    </select>
<x-input-error :messages="$errors->get('servicio_id')" />
</div>
<div class="form-group">
<label for="uuid_fiscal">UUID Fiscal (opcional)</label>
<input id="uuid_fiscal" name="uuid_fiscal" type="text" value="{{ old('uuid_fiscal', $factura->uuid_fiscal) }}">
<x-input-error :messages="$errors->get('uuid_fiscal')" />
</div>
<div class="grid grid-cols-3 gap-3">
<div class="form-group">
<label for="subtotal">Subtotal ($)</label>
<input id="subtotal" name="subtotal" type="number" step="0.01" min="0" value="{{ old('subtotal', $factura->subtotal) }}" required>
<x-input-error :messages="$errors->get('subtotal')" />
</div>
<div class="form-group">
<label for="iva">IVA ($)</label>
<input id="iva" name="iva" type="number" step="0.01" min="0" value="{{ old('iva', $factura->iva) }}" required>
<x-input-error :messages="$errors->get('iva')" />
</div>
<div class="form-group">
<label for="total">Total ($)</label>
<input id="total" name="total" type="number" step="0.01" min="0" value="{{ old('total', $factura->total) }}" required>
<x-input-error :messages="$errors->get('total')" />
</div>
</div>
<div class="form-group">
<label for="estatus">Estatus</label>
<select id="estatus" name="estatus" required>
<option value="vigente" @selected(old('estatus', $factura->estatus) === 'vigente')>Vigente</option>
<option value="cancelada" @selected(old('estatus', $factura->estatus) === 'cancelada')>Cancelada</option>
</select>
<x-input-error :messages="$errors->get('estatus')" />
</div>
<div class="form-group">
<label for="xml_url">URL del XML (opcional)</label>
<input id="xml_url" name="xml_url" type="text" value="{{ old('xml_url', $factura->xml_url) }}">
<x-input-error :messages="$errors->get('xml_url')" />
</div>
<div class="form-group">
<label for="pdf_url">URL del PDF (opcional)</label>
<input id="pdf_url" name="pdf_url" type="text" value="{{ old('pdf_url', $factura->pdf_url) }}">
<x-input-error :messages="$errors->get('pdf_url')" />
</div>
<div class="flex items-center gap-3 pt-2">
<button type="submit" class="btn btn-primary">Actualizar</button>
<a href="{{ route('facturas.index') }}" class="btn btn-ghost">Cancelar</a>
</div>
</form>
</div>
</div>
</div>@endsection
