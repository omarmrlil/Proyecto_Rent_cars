<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    use HasFactory;

    protected $table = 'mantenimientos';
    protected $primaryKey = 'id_mantenimiento';

    protected $fillable = [
        'id_auto',
        'fecha_mantenimiento',
        'tipo_mantenimiento',
        'descripcion',
        'costo',
        'kilometraje',
        'realizado_por',
        'tiempo_estimado',
    ];

    public function auto()
    {
        return $this->belongsTo(Auto::class, 'id_auto');
    }

    public function empleado()
    {

        return $this->belongsTo(Empleado::class, 'realizado_por')
        ->with('usuario'); 
    }

    public function piezas()
    {
        return $this->belongsToMany(InventarioPieza::class, 'mantenimientos_piezas', 'id_mantenimiento', 'id_pieza')
            ->withPivot('cantidad_utilizada');
    }


}
