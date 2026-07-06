<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CargaDiesel extends Model
{
    use Traits\BelongsToEmpresa;

    protected $table = 'cargas_diesel';

    protected $fillable = [
        'empresa_id',
        'unidad_id',
        'operador_id',
        'litros',
        'costo_litro',
        'importe_total',
        'km_actual',
        'fecha_carga',
        'observaciones',
    ];

    protected function casts(): array
    {
        return [
            'fecha_carga' => 'datetime',
        ];
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function unidad()
    {
        return $this->belongsTo(Unidad::class);
    }

    public function operador()
    {
        return $this->belongsTo(Operador::class);
    }
}
