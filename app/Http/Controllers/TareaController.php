<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\Empleado;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    public function index()
    {
        $tareas = Tarea::with('empleado')->get();
        return view('tareas.index', compact('tareas'));
    }

    public function create()
    {
        $empleados = Empleado::all();
        return view('tareas.create', compact('empleados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_empleado' => 'required|exists:empleados,id_empleado',
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_limite' => 'nullable|date|after_or_equal:today',
        ]);

        Tarea::create($request->all());

        return redirect()->route('tareas.index')->with('success', 'Tarea creada exitosamente.');
    }

    public function edit($id)
    {
        $tarea = Tarea::findOrFail($id);
        $empleados = Empleado::all();
        return view('tareas.edit', compact('tarea', 'empleados'));
    }

    public function update(Request $request, $id)
    {
        $tarea = Tarea::findOrFail($id);

        $request->validate([
            'id_empleado' => 'required|exists:empleados,id_empleado',
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_limite' => 'nullable|date|after_or_equal:today',
            'estado' => 'required|in:pendiente,en progreso,completada',
        ]);

        $tarea->update($request->all());

        return redirect()->route('tareas.index')->with('success', 'Tarea actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->delete();

        return redirect()->route('tareas.index')->with('success', 'Tarea eliminada exitosamente.');
    }
}
