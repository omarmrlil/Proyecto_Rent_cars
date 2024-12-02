<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Usuario;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function index()
    {
        $empleados = Empleado::with('usuario')->get();
        return view('empleados.index', compact('empleados'));
    }

    public function create()
    {
        $usuarios = Usuario::where('rol', 'empleado')->get();
        return view('empleados.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_usuario' => 'required|exists:usuarios,id_usuario',
            'cargo' => 'required|string|max:50',
            'fecha_contratacion' => 'required|date',
            'salario' => 'required|numeric|min:0',
        ]);

        Empleado::create($request->all());

        return redirect()->route('empleados.index')->with('success', 'Empleado creado exitosamente.');


    }

    public function edit($id)
    {
        $empleado = Empleado::findOrFail($id);
        $usuarios = Usuario::where('rol', 'empleado')->get();
        return view('empleados.edit', compact('empleado', 'usuarios'));
    }

    public function update(Request $request, $id)
    {
        $empleado = Empleado::findOrFail($id);

        $request->validate([
            'id_usuario' => 'required|exists:usuarios,id_usuario',
            'cargo' => 'required|string|max:50',
            'fecha_contratacion' => 'required|date',
            'salario' => 'required|numeric|min:0',
        ]);

        $empleado->update($request->all());

        return redirect()->route('empleados.index')->with('success', 'Empleado actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $empleado = Empleado::findOrFail($id);
        $empleado->delete();

        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado exitosamente.');
    }
}
