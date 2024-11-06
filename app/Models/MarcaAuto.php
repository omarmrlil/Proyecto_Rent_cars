<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarcaAuto extends Model
{
    use HasFactory;
    protected $table = 'marcas_auto';
    protected $primaryKey = 'id_marca';
}
