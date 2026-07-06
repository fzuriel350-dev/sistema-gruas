<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use Traits\BelongsToEmpresa;

    protected $table = 'facturas';

    protected $fillable = [
        'empresa_id',
        'cliente_id',
        'servicio_id',
        'uuid_fiscal',
        'folio_factura',
        'subtotal',
        'iva',
        'total',
        'xml_url',
        'pdf_url',
        'estatus',
    ];

    const ESTATUS = ['vigente', 'cancelada'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }
}
