<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteCotizacionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->isCliente();
    }

    public function rules(): array
    {
        return [
            'aseguradora_id' => 'required|exists:aseguradoras,id',
            'tipo_servicio_id' => 'required|exists:tipos_servicio,id',
            'no_poliza' => 'nullable|string|max:50',
            'nombre_asegurado' => 'nullable|string|max:255',
            'telefono_asegurado' => 'nullable|string|max:20',
            'no_expediente' => 'nullable|string|max:100',
            'marca' => 'required|string|max:100',
            'modelo' => 'required|string|max:100',
            'ano' => 'nullable|integer|min:1900|max:2099',
            'color' => 'nullable|string|max:50',
            'placas' => 'required|string|max:20',
            'origen' => 'required|string',
            'destino' => 'required|string',
            'distancia_km' => 'required|numeric|min:0',
            'tiempo_estimado' => 'required|integer|min:0',
            'tipo_ruta' => 'required|in:local,foraneo',
            'con_peaje' => 'boolean',
            'num_casetas' => 'nullable|integer|min:0',
            'costo_casetas' => 'nullable|numeric|min:0',
            'extras' => 'nullable|numeric|min:0',
            'convenio_id' => 'nullable|exists:convenios,id',
            'notas' => 'nullable|string',
            'action' => 'required|in:draft,generate',
        ];
    }

    public function messages(): array
    {
        return [
            'aseguradora_id.required' => 'Selecciona una aseguradora.',
            'tipo_servicio_id.required' => 'Selecciona un tipo de servicio.',
            'marca.required' => 'La marca del vehículo es obligatoria.',
            'modelo.required' => 'El modelo del vehículo es obligatorio.',
            'placas.required' => 'Las placas del vehículo son obligatorias.',
            'origen.required' => 'El origen es obligatorio.',
            'destino.required' => 'El destino es obligatorio.',
            'distancia_km.required' => 'La distancia es obligatoria.',
            'tiempo_estimado.required' => 'El tiempo estimado es obligatorio.',
        ];
    }
}
