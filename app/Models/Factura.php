<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $table = 'facturas';
    protected $primaryKey = 'id_factura';
    public $timestamps = false; // Deshabilitar timestamps automáticos

    protected $fillable = [
        'id_alquiler',
        'numero_factura',
        'monto_total',
        'monto_impuesto',
        'fecha_emision', // Opcional si deseas establecer la fecha manualmente
    ];

    public function alquiler()
    {
        return $this->belongsTo(Alquiler::class, 'id_alquiler');
    }

    public function pagos()
    {
        return $this->hasManyThrough(Pago::class, Alquiler::class, 'id_alquiler', 'id_alquiler', 'id_alquiler', 'id_alquiler');
    }
    public function pago()
    {
        return $this->hasOne(Pago::class, 'id_factura');
    }


}
