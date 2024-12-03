<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alquiler extends Model
{
    use HasFactory;

    protected $table = 'alquileres';

    protected $primaryKey = 'id_alquiler'; // Indica que la clave primaria es 'id_alquiler'

    protected $fillable = [
        'id_cliente',
        'id_auto',
        'fecha_inicio',
        'fecha_fin',
        'costo_total',
        'estado',
    ];

    // Si no estás utilizando los campos created_at y updated_at
    public $timestamps = false;

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function pago()
    {
        return $this->hasOne(Pago::class, 'id_alquiler');
    }

    public function factura()
    {
        return $this->hasOne(Factura::class, 'id_alquiler');
    }
    public function auto()
    {
        return $this->belongsTo(Auto::class, 'id_auto', 'id_auto');
    }
    public function marca()
    {
        return $this->belongsTo(MarcaAuto::class, 'id_marca', 'id_marca');
    }

}
