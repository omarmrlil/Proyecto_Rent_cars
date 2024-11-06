<?php

namespace App\Http\Controllers;

use App\Models\Alquiler;
use App\Models\Pago;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class ReporteController extends Controller
{
    // Método para mostrar la vista de generación de reportes
    public function index()
    {
        return view('reportes.index');
    }

    // Método para generar el reporte en PDF
    public function generar(Request $request)
    {
        $request->validate([
            'tipo_reporte' => 'required|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        $tipo = $request->tipo_reporte;
        $fechaInicio = $request->fecha_inicio;
        $fechaFin = $request->fecha_fin;

        if ($tipo === 'alquileres') {
            $data = Alquiler::whereBetween('fecha_inicio', [$fechaInicio, $fechaFin])->get();
            $view = 'reportes.alquileres_pdf';
        } elseif ($tipo === 'pagos') {
            $data = Pago::whereBetween('fecha_pago', [$fechaInicio, $fechaFin])->get();
            $view = 'reportes.pagos_pdf';
        } else {
            return redirect()->back()->with('error', 'Tipo de reporte no válido.');
        }

        $pdf = PDF::loadView($view, compact('data', 'fechaInicio', 'fechaFin'));
        return $pdf->download("reporte_{$tipo}_{$fechaInicio}_{$fechaFin}.pdf");
    }
}
