<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarioPieza extends Model
{
    use HasFactory;

    protected $table = 'inventario_piezas';

    protected $primaryKey = 'id_pieza';

    protected $fillable = [
        'nombre_pieza',
        'cantidad_disponible',
        'costo_unidad',
        'proveedor',
        'stock_minimo',
    ];
    public $timestamps = false;
    public function mantenimientos()
    {
        return $this->belongsToMany(Mantenimiento::class, 'mantenimientos_piezas', 'id_pieza', 'id_mantenimiento')
            ->withPivot('cantidad_utilizada');
    }

}
