<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'email',
        'password',
        'rol',
        'estado',
    ];

    protected $primaryKey = 'id_usuario';

    // Deshabilitar timestamps automáticos
    public $timestamps = false;

    // Ocultar el campo password para mayor seguridad
    protected $hidden = [
        'password',
    ];

    // Asegurar que la contraseña siempre esté hasheada
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    // Relación con Cliente
    public function cliente()
    {
        return $this->hasOne(Cliente::class, 'id_usuario');
    }

    // Relación con Empleado
    public function empleado()
    {
        return $this->hasOne(Empleado::class, 'id_usuario');
    }
}
