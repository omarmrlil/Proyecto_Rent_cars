<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Alquiler;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    // Método para listar todos los pagos
    public function index()
    {
        $pagos = Pago::with('alquiler.cliente.usuario')->get();
        return view('pagos.index', compact('pagos'));
    }

    // Método para mostrar el formulario de creación de un nuevo pago
    public function create()
    {
        $alquileres = Alquiler::all();
        return view('pagos.create', compact('alquileres'));
    }

    // Método para almacenar un nuevo pago en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'id_alquiler' => 'required|exists:alquileres,id_alquiler',
            'monto' => 'required|numeric|min:0',
            'metodo_pago' => 'required|string|max:50',
            'referencia_transaccion' => 'nullable|string|max:100',
        ]);

        Pago::create($request->all());

        return redirect()->route('pagos.index')->with('success', 'Pago registrado exitosamente.');
    }

    // Método para mostrar el formulario de edición de un pago
    public function edit($id)
    {
        $pago = Pago::findOrFail($id);
        $alquileres = Alquiler::all();
        return view('pagos.edit', compact('pago', 'alquileres'));
    }

    // Método para actualizar un pago en la base de datos
    public function update(Request $request, $id)
    {
        $pago = Pago::findOrFail($id);

        $request->validate([
            'id_alquiler' => 'required|exists:alquileres,id_alquiler',
            'monto' => 'required|numeric|min:0',
            'metodo_pago' => 'required|string|max:50',
            'referencia_transaccion' => 'nullable|string|max:100',
        ]);

        $pago->update($request->all());

        return redirect()->route('pagos.index')->with('success', 'Pago actualizado exitosamente.');
    }

    // Método para eliminar un pago de la base de datos
    public function destroy($id)
    {
        $pago = Pago::findOrFail($id);
        $pago->delete();

        return redirect()->route('pagos.index')->with('success', 'Pago eliminado exitosamente.');
    }
}
