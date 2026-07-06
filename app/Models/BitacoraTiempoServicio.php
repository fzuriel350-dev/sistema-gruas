<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BitacoraTiempoServicio extends Model
{
    protected $table = 'bitacora_tiempos_servicio';

    protected $fillable = [
        'servicio_id',
        'hora_asignado',
        'hora_inicio_servicio',
        'hora_en_sitio_origen',
        'hora_salida_destino',
        'hora_en_destino',
        'hora_finalizado',
    ];

    protected function casts(): array
    {
        return [
            'hora_asignado' => 'datetime',
            'hora_inicio_servicio' => 'datetime',
            'hora_en_sitio_origen' => 'datetime',
            'hora_salida_destino' => 'datetime',
            'hora_en_destino' => 'datetime',
            'hora_finalizado' => 'datetime',
        ];
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }
}
