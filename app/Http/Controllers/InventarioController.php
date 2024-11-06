<?php

namespace App\Http\Controllers;

use App\Models\InventarioPieza;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    // Listar todas las piezas del inventario
    public function index()
    {
        $piezas = InventarioPieza::all();
        return view('inventarios.index', compact('piezas'));
    }

    // Mostrar el formulario para crear una nueva pieza
    public function create()
    {
        return view('inventarios.create');
    }

    // Almacenar una nueva pieza en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre_pieza' => 'required|string|max:100',
            'cantidad_disponible' => 'required|integer|min:0',
            'costo_unidad' => 'required|numeric|min:0',
            'proveedor' => 'nullable|string|max:100',
            'stock_minimo' => 'required|integer|min:0',
        ]);

        InventarioPieza::create($request->all());

        return redirect()->route('inventarios.index')->with('success', 'Pieza agregada al inventario exitosamente.');
    }

    // Mostrar el formulario de edición de una pieza
    public function edit($id)
    {
        $pieza = InventarioPieza::findOrFail($id);
        return view('inventarios.edit', compact('pieza'));
    }

    // Actualizar una pieza en la base de datos
    public function update(Request $request, $id)
    {
        $pieza = InventarioPieza::findOrFail($id);

        $request->validate([
            'nombre_pieza' => 'required|string|max:100',
            'cantidad_disponible' => 'required|integer|min:0',
            'costo_unidad' => 'required|numeric|min:0',
            'proveedor' => 'nullable|string|max:100',
            'stock_minimo' => 'required|integer|min:0',
        ]);

        $pieza->update($request->all());

        return redirect()->route('inventarios.index')->with('success', 'Pieza actualizada exitosamente.');
    }

    // Eliminar una pieza del inventario
    public function destroy($id)
    {
        $pieza = InventarioPieza::findOrFail($id);
        $pieza->delete();

        return redirect()->route('inventarios.index')->with('success', 'Pieza eliminada del inventario.');
    }
}
