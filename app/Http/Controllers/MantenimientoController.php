<?php

namespace App\Http\Controllers;

use App\Models\Mantenimiento;
use App\Models\Auto;
use App\Models\Empleado;
use App\Models\Notificacion;
use Illuminate\Http\Request;

class MantenimientoController extends Controller
{
    // Método para listar todos los mantenimientos
    public function index()
    {
        $mantenimientos = Mantenimiento::with('auto', 'empleado')->get();
        return view('mantenimientos.index', compact('mantenimientos'));
    }

    // Método para mostrar el formulario de creación de un nuevo mantenimiento
    public function create()
    {
        $autos = Auto::all();
        $empleados = Empleado::all();
        return view('mantenimientos.create', compact('autos', 'empleados'));
    }

    // Método para almacenar un nuevo mantenimiento en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'id_auto' => 'required|exists:autos,id_auto',
            'fecha_mantenimiento' => 'required|date',
            'tipo_mantenimiento' => 'required|in:preventivo,correctivo',
            'descripcion' => 'nullable|string',
            'costo' => 'required|numeric|min:0',
            'kilometraje' => 'required|integer|min:0',
            'realizado_por' => 'required|exists:empleados,id_empleado',
        ]);

        $mantenimiento = Mantenimiento::create($request->all());

        // Crear una notificación para el empleado encargado del mantenimiento
        Notificacion::create([
            'id_usuario' => $mantenimiento->empleado->id_usuario,
            'tipo_notificacion' => 'mantenimiento',
            'mensaje' => "Tienes un mantenimiento programado para el vehículo " . $mantenimiento->auto->modelo . " el " . $mantenimiento->fecha_mantenimiento . ".",
            'estado' => 'pendiente',
            'fecha_envio' => now(),
        ]);

        return redirect()->route('mantenimientos.index')->with('success', 'Mantenimiento registrado exitosamente.');
    }

    // Método para mostrar un mantenimiento específico
    public function show($id)
    {
        $mantenimiento = Mantenimiento::with('auto', 'empleado')->findOrFail($id);
        return view('mantenimientos.show', compact('mantenimiento'));
    }

    // Método para mostrar el formulario de edición de un mantenimiento
    public function edit($id)
    {
        $mantenimiento = Mantenimiento::findOrFail($id);
        $autos = Auto::all();
        $empleados = Empleado::all();
        return view('mantenimientos.edit', compact('mantenimiento', 'autos', 'empleados'));
    }

    // Método para actualizar un mantenimiento en la base de datos
    public function update(Request $request, $id)
    {
        $mantenimiento = Mantenimiento::findOrFail($id);

        $request->validate([
            'id_auto' => 'required|exists:autos,id_auto',
            'fecha_mantenimiento' => 'required|date',
            'tipo_mantenimiento' => 'required|in:preventivo,correctivo',
            'descripcion' => 'nullable|string',
            'costo' => 'required|numeric|min:0',
            'kilometraje' => 'required|integer|min:0',
            'realizado_por' => 'required|exists:empleados,id_empleado',
        ]);

        $mantenimiento->update($request->all());

        return redirect()->route('mantenimientos.index')->with('success', 'Mantenimiento actualizado exitosamente.');
    }

    // Método para eliminar un mantenimiento de la base de datos
    public function destroy($id)
    {
        $mantenimiento = Mantenimiento::findOrFail($id);
        $mantenimiento->delete();

        return redirect()->route('mantenimientos.index')->with('success', 'Mantenimiento eliminado exitosamente.');
    }
}
