<?php

namespace App\Http\Controllers;

use App\Models\Alquiler;
use App\Models\Cliente;
use App\Models\Auto;
use Illuminate\Http\Request;
use App\Models\Notificacion;

class AlquilerController extends Controller
{
    // Método para listar todos los alquileres
    public function index()
    {
        $alquileres = Alquiler::with('cliente.usuario', 'auto')->get();
        return view('alquileres.index', compact('alquileres'));
    }

    // Método para mostrar el formulario de creación de un nuevo alquiler
    public function create()
    {
        $clientes = Cliente::with('usuario')->get();
        $autos = Auto::where('estado', 'disponible')->get();
        return view('alquileres.create', compact('clientes', 'autos'));
    }

    // Método para almacenar un nuevo alquiler en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'id_cliente' => 'required|exists:clientes,id_cliente',
            'id_auto' => 'required|exists:autos,id_auto',
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'costo_total' => 'required|numeric|min:0',
        ]);

        $alquiler = Alquiler::create($request->all());

        // Cambiar el estado del auto a 'alquilado'
        $auto = Auto::find($request->id_auto);
        $auto->update(['estado' => 'alquilado']);

        // Crear una notificación para el cliente
        Notificacion::create([
            'id_usuario' => $alquiler->cliente->id_usuario,
            'tipo_notificacion' => 'devolución',
            'mensaje' => "Recuerda devolver el vehículo alquilado el " . $alquiler->fecha_fin . ".",
            'estado' => 'pendiente',
            'fecha_envio' => now(),
        ]);
        return redirect()->route('alquileres.index')->with('success', 'Alquiler registrado exitosamente.');
    }

    // Método para mostrar el formulario de edición de un alquiler
    public function edit($id)
    {
        $alquiler = Alquiler::findOrFail($id);
        $clientes = Cliente::with('usuario')->get();
        $autos = Auto::all();
        return view('alquileres.edit', compact('alquiler', 'clientes', 'autos'));
    }

    // Método para actualizar un alquiler en la base de datos
    public function update(Request $request, $id)
    {
        $alquiler = Alquiler::findOrFail($id);

        $request->validate([
            'id_cliente' => 'required|exists:clientes,id_cliente',
            'id_auto' => 'required|exists:autos,id_auto',
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'costo_total' => 'required|numeric|min:0',
        ]);

        // Cambiar el estado del auto si se ha modificado
        if ($alquiler->id_auto != $request->id_auto) {
            // Cambiar el estado del auto anterior a 'disponible'
            $autoAnterior = Auto::find($alquiler->id_auto);
            $autoAnterior->update(['estado' => 'disponible']);

            // Cambiar el estado del nuevo auto a 'alquilado'
            $nuevoAuto = Auto::find($request->id_auto);
            $nuevoAuto->update(['estado' => 'alquilado']);
        }

        $alquiler->update($request->all());

        return redirect()->route('alquileres.index')->with('success', 'Alquiler actualizado exitosamente.');
    }

    // Método para eliminar un alquiler de la base de datos
    public function destroy($id)
    {
        $alquiler = Alquiler::findOrFail($id);

        // Cambiar el estado del auto a 'disponible' antes de eliminar el alquiler
        $auto = Auto::find($alquiler->id_auto);
        $auto->update(['estado' => 'disponible']);

        $alquiler->delete();

        return redirect()->route('alquileres.index')->with('success', 'Alquiler eliminado exitosamente.');
    }
}
