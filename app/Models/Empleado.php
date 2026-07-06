<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empleado extends Model
{
    use SoftDeletes, Traits\BelongsToEmpresa;

    protected $fillable = [
        'empresa_id',
        'oficina_id',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'telefono',
        'direccion',
        'puesto',
        'sueldo_diario',
    ];

    protected function casts(): array
    {
        return [
            'sueldo_diario' => 'decimal:2',
        ];
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function oficina()
    {
        return $this->belongsTo(Oficina::class);
    }

    public function usuario()
    {
        return $this->hasOne(User::class);
    }

    public function operador()
    {
        return $this->hasOne(Operador::class);
    }

    public function nombreCompleto(): string
    {
        return trim("{$this->nombre} {$this->apellido_paterno} {$this->apellido_materno}");
    }
}
