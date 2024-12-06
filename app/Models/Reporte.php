<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    use HasFactory;

    // Especificar la tabla si no sigue la convención de pluralización
    protected $table = 'reportes';

    // Especificar la clave primaria (id_reporte en lugar de id)
    protected $primaryKey = 'id_reporte';

    // Los campos que pueden ser asignados masivamente
    protected $fillable = [
        'tipo_reporte',
        'estado_reporte',
        'fecha_generacion',
        'ruta_archivo',
    ];

    // Si no usas los campos de tiempo automáticamente generados (created_at, updated_at)
    // protected $timestamps = false;
}
