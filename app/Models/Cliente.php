<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $primaryKey = 'id_cliente';

    protected $fillable = [
        'id_usuario',
        'tipo_documento',
        'documento_identidad',
        'licencia_conducir',
        'telefono',
        'direccion',
        'estado',
    ];

    // Si no estás utilizando los campos created_at y updated_at
    public $timestamps = false;

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function alquileres()
    {
        return $this->hasMany(Alquiler::class, 'id_cliente', 'id_cliente');
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class, 'id_cliente', 'id_cliente');
    }


}
