<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auto extends Model
{

    use HasFactory;

    protected $table = 'autos';
    protected $primaryKey = 'id_auto';

    protected $fillable = [
        'id_marca',
        'id_tipo',
        'modelo',
        'año',
        'matricula',
        'precio_por_dia',
        'foto_auto',
        'kilometraje',
        'estado',
    ];

    public function detalles()
    {
        return $this->hasOne(DetalleAuto::class, 'id_auto', 'id_auto');
    }

    // Si no estás utilizando los campos created_at y updated_at
    public $timestamps = false;

    public function alquileres()
    {
        return $this->hasMany(Alquiler::class, 'id_auto');
    }

    public function mantenimientos()
    {
        return $this->hasMany(Mantenimiento::class, 'id_auto');
    }
    public function marca()
    {
        return $this->belongsTo(MarcaAuto::class, 'id_marca', 'id_marca');
    }



    public function tipo()
    {
        return $this->belongsTo(TipoAuto::class, 'id_tipo');
    }
    public function multimedia()
    {
        return $this->hasMany(MultimediaAuto::class, 'id_auto');
    }


}
