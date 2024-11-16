<?php

namespace App\Http\Controllers;

use App\Models\Auto;
use App\Models\DetalleAuto;
use App\Models\MarcaAuto;
use App\Models\TipoAuto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AutoController extends Controller
{
    public function index()
    {
        $autos = Auto::with('marca', 'tipo', 'detalles')->get();
        return view('autos.index', compact('autos'));
    }

    public function create()
    {
        $marcas = MarcaAuto::all();
        $tipos = TipoAuto::all();
        return view('autos.create', compact('marcas', 'tipos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_marca' => 'required|exists:marcas_auto,id_marca',
            'id_tipo' => 'required|exists:tipos_auto,id_tipo',
            'modelo' => 'required|string|max:50',
            'año' => 'required|integer|min:1900|max:' . date('Y'),
            'matricula' => 'required|string|unique:autos,matricula|max:50',
            'precio_por_dia' => 'required|numeric|min:0',
            'kilometraje' => 'required|integer|min:0',
            'foto_auto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'transmision' => 'required|in:manual,automatica',
            'consumo_combustible' => 'required|numeric|min:0',
            'capacidad_tanque' => 'required|numeric|min:0',
            'numero_asientos' => 'required|integer|min:1',
            'numero_puertas' => 'required|integer|min:1',
            'color' => 'required|string|max:50',
            'tipo_combustible' => 'required|in:gasolina,diesel,electrico,hibrido',
            'capacidad_maletero' => 'nullable|integer|min:0',
            'aire_acondicionado' => 'required|in:sí,no',
            'gps' => 'required|in:sí,no',
            'velocidad_maxima' => 'required|integer|min:0',
            'peso' => 'required|numeric|min:0',
            'fecha_compra' => 'required|date',
            'condicion' => 'required|in:nuevo,usado',
        ]);

        $data = $request->all();
        if ($request->hasFile('foto_auto')) {
            $data['foto_auto'] = $request->file('foto_auto')->store('fotos_autos', 'public');
        }

        // Crear el auto
        $auto = Auto::create($data);

        // Crear los detalles del auto asociado
        $auto->detalles()->create([
            'transmision' => $request->transmision,
            'consumo_combustible' => $request->consumo_combustible,
            'capacidad_tanque' => $request->capacidad_tanque,
            'numero_asientos' => $request->numero_asientos,
            'numero_puertas' => $request->numero_puertas,
            'color' => $request->color,
            'tipo_combustible' => $request->tipo_combustible,
            'capacidad_maletero' => $request->capacidad_maletero,
            'aire_acondicionado' => $request->aire_acondicionado,
            'gps' => $request->gps,
            'velocidad_maxima' => $request->velocidad_maxima,
            'peso' => $request->peso,
            'fecha_compra' => $request->fecha_compra,
            'condicion' => $request->condicion,
        ]);

        return redirect()->route('autos.index')->with('success', 'Auto y sus detalles registrados exitosamente.');
    }

    public function show($id)
    {
        $auto = Auto::with('detalles')->findOrFail($id);
        return view('autos.show', compact('auto'));
    }

    public function edit($id)
    {
        $auto = Auto::with('detalles')->findOrFail($id);
        $marcas = MarcaAuto::all();
        $tipos = TipoAuto::all();
        return view('autos.edit', compact('auto', 'marcas', 'tipos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_marca' => 'required|exists:marcas_auto,id_marca',
            'id_tipo' => 'required|exists:tipos_auto,id_tipo',
            'modelo' => 'required|string|max:50',
            'año' => 'required|integer|min:1900|max:' . date('Y'),
            'matricula' => 'required|string|max:50|unique:autos,matricula,' . $id . ',id_auto',
            'precio_por_dia' => 'required|numeric|min:0',
            'foto_auto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $auto = Auto::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('foto_auto')) {
            if ($auto->foto_auto && Storage::exists($auto->foto_auto)) {
                Storage::delete($auto->foto_auto);
            }
            $data['foto_auto'] = $request->file('foto_auto')->store('fotos_autos', 'public');
        }

        $auto->update($data);

        return redirect()->route('autos.index')->with('success', 'Auto actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $auto = Auto::findOrFail($id);
        if ($auto->foto_auto && Storage::exists($auto->foto_auto)) {
            Storage::delete($auto->foto_auto);
        }
        $auto->delete();

        return redirect()->route('autos.index')->with('success', 'Auto eliminado exitosamente.');
    }

    public function search(Request $request)
    {
        $query = Auto::query();

        if ($request->filled('marca')) {
            $query->whereHas('marca', function ($q) use ($request) {
                $q->where('nombre_marca', 'like', '%' . $request->marca . '%');
            });
        }

        if ($request->filled('modelo')) {
            $query->where('modelo', 'like', '%' . $request->modelo . '%');
        }

        if ($request->filled('precio_max')) {
            $query->where('precio_por_dia', '<=', $request->precio_max);
        }

        $autos = $query->get();

        return view('search_results', compact('autos'));
    }
}
