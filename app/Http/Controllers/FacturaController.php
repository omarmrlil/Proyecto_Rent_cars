<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Alquiler;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    public function index()
    {
        $facturas = Factura::with('alquiler')->get();
        return view('facturas.index', compact('facturas'));
    }

    public function create()
    {
        $alquileres = Alquiler::all();
        return view('facturas.create', compact('alquileres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_alquiler' => 'required|exists:alquileres,id_alquiler',
            'numero_factura' => 'required|string|unique:facturas,numero_factura|max:50',
            'monto_total' => 'required|numeric|min:0',
            'monto_impuesto' => 'required|numeric|min:0',
        ]);

        Factura::create($request->all());

        return redirect()->route('facturas.index')->with('success', 'Factura creada exitosamente.');
    }

    public function edit($id)
    {
        $factura = Factura::findOrFail($id);
        $alquileres = Alquiler::all();
        return view('facturas.edit', compact('factura', 'alquileres'));
    }

    public function update(Request $request, $id)
    {
        $factura = Factura::findOrFail($id);

        $request->validate([
            'id_alquiler' => 'required|exists:alquileres,id_alquiler',
            'numero_factura' => 'required|string|max:50|unique:facturas,numero_factura,' . $id . ',id_factura',
            'monto_total' => 'required|numeric|min:0',
            'monto_impuesto' => 'required|numeric|min:0',
        ]);

        $factura->update($request->all());

        return redirect()->route('facturas.index')->with('success', 'Factura actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $factura = Factura::findOrFail($id);
        $factura->delete();

        return redirect()->route('facturas.index')->with('success', 'Factura eliminada exitosamente.');
    }
}
