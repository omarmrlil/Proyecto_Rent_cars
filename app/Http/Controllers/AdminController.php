<?php

namespace App\Http\Controllers;

use App\Models\Auto;
use App\Models\Cliente;
use App\Models\Alquiler;
use App\Models\Pago;
use App\Models\InventarioPieza;
use App\Models\Mantenimiento;
use App\Models\Empleado;
use App\Models\CajaMovimiento;
use App\Models\Notificacion;

use Illuminate\Http\Request;


class AdminController extends Controller
{
    // Mostrar el panel de administración
    public function index()
    {
        // Definir las variables antes de usarlas
        $totalAutos = Auto::count();
        $totalClientes = Cliente::count();
        $alquileresActivos = Alquiler::where('estado', 'pendiente')->count();
        $ingresosTotales = Pago::sum('monto');

        // Datos adicionales para piezas e inventario
        $piezasDisponibles = InventarioPieza::where('cantidad_disponible', '>', 0)->get();

        $mantenimientosRecientes = Mantenimiento::with('empleado.usuario', 'auto')
        ->orderBy('fecha_mantenimiento', 'desc')
        ->limit(5)
        ->get();

        // Obtener datos para los gráficos
        $alquileresPorMes = Alquiler::selectRaw('MONTH(fecha_inicio) as mes, COUNT(*) as total')
            ->groupBy('mes')
            ->pluck('total', 'mes');

        $ingresosPorMes = Pago::selectRaw('MONTH(fecha_pago) as mes, SUM(monto) as total')
            ->groupBy('mes')
            ->pluck('total', 'mes');

        // Alquileres recientes
        $alquileresRecientes = Alquiler::with(['cliente', 'auto'])
            ->orderBy('fecha_inicio', 'desc')
            ->limit(5)
            ->get();

        // Pasar todas las variables a la vista
        return view('admin.index', compact(
            'totalAutos',
            'totalClientes',
            'alquileresActivos',
            'ingresosTotales',
            'alquileresPorMes',
            'ingresosPorMes',
            'alquileresRecientes',
            'piezasDisponibles',
            'mantenimientosRecientes'
        ));
    }
    public function empleados()
    {
        $empleados = Empleado::with('usuario')->get();
        return view('admin.empleados', compact('empleados'));
    }

public function inventarioPiezas()
{
    $piezas = InventarioPieza::all();
    return view('admin.inventario', compact('piezas'));
}
    public function historialMantenimientos()
    {
        $mantenimientos = Mantenimiento::with('auto', 'empleado')->get();
        return view('admin.historial_mantenimientos', compact('mantenimientos'));
    }

    public function reportesFinancieros()
{
    // Reporte de ingresos y egresos
    $ingresosTotales = Pago::sum('monto');
    $egresosTotales = CajaMovimiento::where('tipo', 'egreso')->sum('monto');

    // Ingresos por mes
    $ingresosPorMes = Pago::selectRaw('MONTH(fecha_pago) as mes, SUM(monto) as total')
        ->groupBy('mes')
        ->pluck('total', 'mes');

    return view('admin.reportes_financieros', compact('ingresosTotales', 'egresosTotales', 'ingresosPorMes'));
}

    public function notificaciones()
    {
        $notificacionesRecientes = Notificacion::orderBy('fecha_creacion', 'desc')
            ->limit(5)
            ->get();

        return view('admin.notificaciones', compact('notificacionesRecientes'));
    }

    // Otros métodos del AdminController
}
