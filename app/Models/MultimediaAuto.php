<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultimediaAuto extends Model
{
    use HasFactory;
    protected $table = 'multimedia_autos';

    public function auto()
    {
        return $this->belongsTo(Auto::class, 'id_auto');
    }

}
