<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Usuario;
use App\Models\Auto;
use App\Models\Notificacion;
use App\Models\Mantenimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Tarea;


class EmpleadoController extends Controller
{
    public function index()
    {
        $usuario = session('usuario');

        $mantenimientos = Mantenimiento::where('realizado_por', $usuario->id_usuario)->get();
        $autosEnMantenimiento = Auto::where('estado', 'mantenimiento')->count();

        $notificacionesPendientes = Notificacion::where('id_usuario', $usuario->id_usuario)
            ->where('estado', 'pendiente')
            ->count();

        // Agregar tarea pendiente
        $tareasPendientes = Tarea::where('id_empleado', $usuario->id_usuario)
            ->where('estado', 'pendiente')
            ->count();

        $mantenimientosTotales = Mantenimiento::count();

        return view('empleados.index', compact(
            'mantenimientos',
            'autosEnMantenimiento',
            'notificacionesPendientes',
            'mantenimientosTotales',
            'tareasPendientes'
        ));
    }



    public function mantenimientos()
    {
        // Lista de mantenimientos
        $mantenimientos = Mantenimiento::with('auto')->orderBy('fecha_mantenimiento', 'desc')->get();
        return view('empleados.mantenimientos', compact('mantenimientos'));
    }

    // CRUD de empleados
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


    public function perfil()
    {
        $usuario = session('usuario');
        $empleado = Empleado::where('id_usuario', $usuario->id_usuario)->first();

        return view('empleados.perfil', compact('empleado', 'usuario'));
    }

    /**
     * Actualizar la información del perfil.
     */
    public function actualizarPerfil(Request $request)
    {
        $usuario = session('usuario');
        $empleado = Empleado::where('id_usuario', $usuario->id_usuario)->first();

        $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:usuarios,email,' . $usuario->id_usuario . ',id_usuario',
            'telefono' => 'nullable|string|max:15',
            'direccion' => 'nullable|string|max:255',
        ]);

        // Actualizar información del usuario
        $usuario->update([
            'nombre' => $request->nombre,
            'email' => $request->email,
        ]);

        // Actualizar información del empleado
        $empleado->update([
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
        ]);

        return redirect()->route('empleado.perfil')->with('success', 'Perfil actualizado exitosamente.');
    }

    /**
     * Cambiar la contraseña del empleado.
     */
    public function cambiarPassword(Request $request)
    {
        $usuario = session('usuario');

        $request->validate([
            'password_actual' => 'required',
            'password_nuevo' => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($request->password_actual, $usuario->password)) {
            return redirect()->back()->with('error', 'La contraseña actual es incorrecta.');
        }

        $usuario->update([
            'password' => Hash::make($request->password_nuevo),
        ]);

        return redirect()->route('empleado.perfil')->with('success', 'Contraseña cambiada exitosamente.');
    }

    public function notificaciones()
    {
        $usuario = session('usuario');
        $notificaciones = Notificacion::where('id_usuario', $usuario->id_usuario)
            ->orderBy('fecha_creacion', 'desc')
            ->get();

        return view('empleados.notificaciones', compact('notificaciones'));
    }

    public function marcarComoVista($id)
    {
        $notificacion = Notificacion::findOrFail($id);
        $notificacion->update(['estado' => 'visto']);

        return redirect()->route('empleado.notificaciones')->with('success', 'Notificación marcada como vista.');
    }

    public function historialActividades(Request $request)
    {
        $usuario = session('usuario');
        $empleado = Empleado::where('id_usuario', $usuario->id_usuario)->first();

        if (!$empleado) {
            return redirect()->route('empleado.dashboard')->withErrors('Empleado no encontrado.');
        }

        // Filtrar por fechas (opcional)
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');

        // Obtener mantenimientos y tareas completadas
        $mantenimientos = Mantenimiento::where('realizado_por', $empleado->id_empleado)
            ->where('estado', 'finalizado')
            ->when($fechaInicio, function ($query) use ($fechaInicio) {
                $query->where('fecha_mantenimiento', '>=', $fechaInicio);
            })
            ->when($fechaFin, function ($query) use ($fechaFin) {
                $query->where('fecha_mantenimiento', '<=', $fechaFin);
            })
            ->get();

        $tareas = Tarea::where('id_empleado', $empleado->id_empleado)
            ->where('estado', 'completada')
            ->when($fechaInicio, function ($query) use ($fechaInicio) {
                $query->where('updated_at', '>=', $fechaInicio);
            })
            ->when($fechaFin, function ($query) use ($fechaFin) {
                $query->where('updated_at', '<=', $fechaFin);
            })
            ->get();

        return view('empleados.historial', compact('mantenimientos', 'tareas', 'fechaInicio', 'fechaFin'));
    }

    public function tareas()
    {
        $usuario = session('usuario');
        $tareas = Tarea::where('id_empleado', $usuario->id_usuario)->get();

        return view('empleados.tareas', compact('tareas'));
    }
    public function detallesMantenimiento($id)
    {
        $mantenimiento = Mantenimiento::with('auto.marca', 'auto.detalles')->findOrFail($id);

        return view('empleados.detalle_mantenimiento', compact('mantenimiento'));
    }

    public function finalizarMantenimiento(Request $request, $id)
    {
        $mantenimiento = Mantenimiento::findOrFail($id);

        if ($mantenimiento->estado !== 'pendiente') {
            return redirect()->back()->with('error', 'El mantenimiento ya está finalizado o no es válido.');
        }

        $mantenimiento->update(['estado' => 'finalizado']);

        return redirect()->route('empleado.mantenimientos')->with('success', 'Mantenimiento finalizado correctamente.');
    }

    public function editarMantenimiento($id)
    {
        $mantenimiento = Mantenimiento::with('auto')->findOrFail($id);

        return view('empleados.editar_mantenimiento', compact('mantenimiento'));
    }

    public function actualizarMantenimiento(Request $request, $id)
    {
        $mantenimiento = Mantenimiento::findOrFail($id);

        $request->validate([
            'tipo_mantenimiento' => 'required|string|max:255',
            'costo' => 'required|numeric|min:0',
            'fecha_mantenimiento' => 'required|date',
            'descripcion' => 'nullable|string',
        ]);

        $mantenimiento->update($request->all());

        return redirect()->route('empleado.mantenimientos')->with('success', 'Mantenimiento actualizado correctamente.');
    }

    public function eliminarMantenimiento($id)
    {
        $mantenimiento = Mantenimiento::findOrFail($id);

        $mantenimiento->delete();

        return redirect()->route('empleado.mantenimientos')->with('success', 'Mantenimiento eliminado correctamente.');
    }


    public function listarMantenimientos(Request $request)
    {
        $usuario = session('usuario');

        // Obtener los filtros de la solicitud
        $estado = $request->input('estado'); // Pendiente, Finalizado, En Progreso
        $fechaDesde = $request->input('fecha_desde');
        $fechaHasta = $request->input('fecha_hasta');

        // Construir la consulta base
        $query = Mantenimiento::where('realizado_por', $usuario->id_usuario);

        // Aplicar filtro por estado si está presente
        if ($estado) {
            $query->where('estado', $estado);
        }

        // Aplicar filtro por rango de fechas si está presente
        if ($fechaDesde && $fechaHasta) {
            $query->whereBetween('fecha_mantenimiento', [$fechaDesde, $fechaHasta]);
        }

        // Obtener los mantenimientos filtrados
        $mantenimientos = $query->with('auto.marca')->orderBy('fecha_mantenimiento', 'desc')->get();

        return view('empleados.mantenimientos', compact('mantenimientos'));
    }

}
