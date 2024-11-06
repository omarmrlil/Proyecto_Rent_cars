<?php

namespace App\Http\Controllers;

use App\Models\Auto; // Modelo de Autos
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class IndexController extends Controller
{
    public function index()
    {
        // Obtener los autos más rentados
        $autos_mas_rentados = Auto::with('marca')
            ->join('alquileres', 'autos.id_auto', '=', 'alquileres.id_auto')
            ->select('autos.*', DB::raw('COUNT(alquileres.id_auto) as total_rentado'))
            ->groupBy('autos.id_auto')
            ->orderBy('total_rentado', 'desc')
            ->limit(5)
            ->get();

        // Pasar los datos a la vista
        return view('index', compact('autos_mas_rentados', 'noticias'));
    }
}
