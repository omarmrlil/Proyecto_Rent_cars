<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $table = 'facturas';
    protected $primaryKey = 'id_factura';
    protected $fillable = [
        'id_alquiler',
        'numero_factura',
        'monto_total',
        'monto_impuesto',
    ];

    public function alquiler()
    {
        return $this->belongsTo(Alquiler::class, 'id_alquiler');
    }

}
