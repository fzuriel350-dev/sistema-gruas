<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ControlNomina extends Model
{
    use Traits\BelongsToEmpresa;

    protected $table = 'control_nomina';

    protected $fillable = [
        'empresa_id',
        'operador_id',
        'fecha_desde',
        'fecha_hasta',
        'sueldo_base_semanal',
        'bonos_servicios',
        'descuentos_prestamos',
        'total_neto_a_pagar',
        'estatus',
    ];

    protected function casts(): array
    {
        return [
            'fecha_desde' => 'date',
            'fecha_hasta' => 'date',
        ];
    }

    const ESTATUS = ['pendiente', 'pagado'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function operador()
    {
        return $this->belongsTo(Operador::class);
    }
}
