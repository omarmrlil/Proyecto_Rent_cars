<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    protected $table = 'empleados';
    protected $primaryKey = 'id_empleado'; // Asegúrate de que coincida con el nombre de la columna en la base de datos
    protected $fillable = [
        'id_usuario',
        'cargo',
        'fecha_contratacion',
        'salario',
    ];
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    public function mantenimientos()
    {
        return $this->hasMany(Mantenimiento::class, 'realizado_por');
    }
    public $timestamps = false;



}
