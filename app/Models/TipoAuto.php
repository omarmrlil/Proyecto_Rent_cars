<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoAuto extends Model
{
    use HasFactory;

    protected $table = 'tipos_auto';

    protected $primaryKey = 'id_tipo'; // Indica que la clave primaria es 'id_tipo'
}
