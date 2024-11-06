<?php

namespace App\Http\Controllers;

use App\Models\Auto;
use App\Models\MarcaAuto;
use App\Models\TipoAuto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AutoController extends Controller
{
    // Método para listar todos los autos
    public function index()
    {
        $autos = Auto::with('marca', 'tipo')->get();
        return view('autos.index', compact('autos'));
    }

    // Método para mostrar el formulario de creación de un nuevo auto
    public function create()
    {
        $marcas = MarcaAuto::all();
        $tipos = TipoAuto::all();
        return view('autos.create', compact('marcas', 'tipos'));
    }

    // Método para almacenar un nuevo auto en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'id_marca' => 'required|exists:marcas_auto,id_marca',
            'id_tipo' => 'required|exists:tipos_auto,id_tipo',
            'modelo' => 'required|string|max:50',
            'año' => 'required|integer|min:1900|max:' . date('Y'),
            'matricula' => 'required|string|unique:autos,matricula|max:50',
            'precio_por_dia' => 'required|numeric|min:0',
            'kilometraje' => 'required|integer|min:0', // Validar el kilometraje
            'foto_auto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);


        $data = $request->all();
        if ($request->hasFile('foto_auto')) {
            $data['foto_auto'] = $request->file('foto_auto')->store('fotos_autos', 'public');
        }

        Auto::create($data);

        return redirect()->route('autos.index')->with('success', 'Auto registrado exitosamente.');
    }

    // Método para mostrar un auto específico (no es necesario si no necesitas una vista detallada)
    public function show($id)
    {
        $auto = Auto::findOrFail($id);
        return view('autos.show', compact('auto'));
    }

    // Método para mostrar el formulario de edición de un auto
    public function edit($id)
    {
        $auto = Auto::findOrFail($id);
        $marcas = MarcaAuto::all();
        $tipos = TipoAuto::all();
        return view('autos.edit', compact('auto', 'marcas', 'tipos'));
    }

    // Método para actualizar un auto en la base de datos
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
            // Eliminar la foto antigua si existe
            if ($auto->foto_auto && Storage::exists($auto->foto_auto)) {
                Storage::delete($auto->foto_auto);
            }
            $data['foto_auto'] = $request->file('foto_auto')->store('fotos_autos', 'public');
        }

        $auto->update($data);

        return redirect()->route('autos.index')->with('success', 'Auto actualizado exitosamente.');
    }

    // Método para eliminar un auto de la base de datos
    public function destroy($id)
    {
        $auto = Auto::findOrFail($id);
        // Eliminar la foto asociada si existe
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
