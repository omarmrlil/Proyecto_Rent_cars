<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use App\Models\Usuario;
use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    public function index()
    {
        $notificaciones = Notificacion::with('usuario')->get();
        return view('notificaciones.index', compact('notificaciones'));
    }

    public function create()
    {
        $usuarios = Usuario::all();
        return view('notificaciones.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_usuario' => 'required|exists:usuarios,id_usuario',
            'tipo_notificacion' => 'required|string',
            'mensaje' => 'required|string',
        ]);

        Notificacion::create([
            'id_usuario' => $request->id_usuario,
            'tipo_notificacion' => $request->tipo_notificacion,
            'mensaje' => $request->mensaje,
            'estado' => 'pendiente',
            'fecha_envio' => now(),
        ]);

        return redirect()->route('notificaciones.index')->with('success', 'Notificación creada y enviada.');
    }

    public function edit($id)
    {
        $notificacion = Notificacion::findOrFail($id);
        $usuarios = Usuario::all();
        return view('notificaciones.edit', compact('notificacion', 'usuarios'));
    }

    public function update(Request $request, $id)
    {
        $notificacion = Notificacion::findOrFail($id);

        $request->validate([
            'id_usuario' => 'required|exists:usuarios,id_usuario',
            'tipo_notificacion' => 'required|string',
            'mensaje' => 'required|string',
        ]);

        $notificacion->update($request->all());
        return redirect()->route('notificaciones.index')->with('success', 'Notificación actualizada.');
    }

    public function destroy($id)
    {
        $notificacion = Notificacion::findOrFail($id);
        $notificacion->delete();

        return redirect()->route('notificaciones.index')->with('success', 'Notificación eliminada.');
    }

    public function marcarVisto($id)
    {
        $notificacion = Notificacion::findOrFail($id);
        $notificacion->estado = 'visto';
        $notificacion->fecha_vista = now();
        $notificacion->save();

        return redirect()->route('notificaciones.mis')->with('success', 'Notificación marcada como vista.');
    }

}
