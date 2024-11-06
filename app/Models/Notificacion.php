<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;

    protected $table = 'notificaciones';

    protected $primaryKey = 'id_notificacion';

    protected $fillable = [
        'id_usuario',
        'tipo_notificacion',
        'mensaje',
        'estado',
        'fecha_envio',
        'fecha_vista',
    ];

    public $timestamps = false;

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}
