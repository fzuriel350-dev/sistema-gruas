<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Oficina extends Model
{
    use SoftDeletes, Traits\BelongsToEmpresa;

    protected $table = 'oficinas';

    protected $fillable = [
        'empresa_id',
        'nombre',
        'direccion',
        'ciudad',
        'estado',
        'telefono',
        'encargado',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function empleados()
    {
        return $this->hasMany(Empleado::class);
    }

    public function unidades()
    {
        return $this->hasMany(Unidad::class);
    }

    public function servicios()
    {
        return $this->hasMany(Servicio::class);
    }
}
