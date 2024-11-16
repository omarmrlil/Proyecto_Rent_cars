<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleAuto extends Model
{
    use HasFactory;
    protected $table = 'detalles_auto';

    protected $fillable = [
        'id_auto',
        'transmision',
        'consumo_combustible',
        'capacidad_tanque',
        'numero_asientos',
        'numero_puertas',
        'color',
        'tipo_combustible',
        'capacidad_maletero',
        'aire_acondicionado',
        'gps',
        'velocidad_maxima',
        'peso',
        'fecha_compra',
        'condicion',
    ];

    public function auto()
    {
        return $this->belongsTo(Auto::class, 'id_auto');
    }
}
