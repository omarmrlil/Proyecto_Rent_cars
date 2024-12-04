<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pagos';

    protected $primaryKey = 'id_pago';

    protected $fillable = [
        'id_alquiler',
        'monto',
        'metodo_pago',
        'referencia_transaccion',
        'fecha_pago',
    ];

    public $timestamps = false;

    public function alquiler()
    {
        return $this->belongsTo(Alquiler::class, 'id_alquiler');
    }
    public function factura()
    {
        return $this->belongsTo(Factura::class, 'id_factura');
    }



}
