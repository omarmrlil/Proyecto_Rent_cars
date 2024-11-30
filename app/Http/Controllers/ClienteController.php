<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Usuario;
use App\Models\Alquiler;
use App\Models\Notificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class ClienteController extends Controller
{
    public function index()
    {
        // Obtener el cliente autenticado
        $usuario = Auth::user();
        $clientes = Cliente::with('usuario')->get();
        return view('clientes.index', compact('clientes', 'usuario'));
    }
    public function show($id)
    {

        $cliente = Cliente::findOrFail($id);


        return view('cliente.show', compact('cliente'));
    }

    public function autos()
    {
        // Obtener todos los autos con sus relaciones necesarias
        $autos = \App\Models\Auto::with(['marca', 'detalles'])->get();

        // Retornar la vista con los autos
        return view('clientes.autos', compact('autos'));
    }


    public function servicios()
    {
        return view('clientes.servicios');
    }

    public function contact()
    {
        return view('clientes.contact');
    }
    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|string|min:6',
            'tipo_documento' => 'required|in:cedula,pasaporte',
            'documento_identidad' => 'required|string|unique:clientes,documento_identidad',
            'licencia_conducir' => 'required|string',
            'telefono' => 'nullable|string|max:15',
            'direccion' => 'nullable|string|max:255',
        ]);

        // Crear usuario y cliente
        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'rol' => 'cliente',
        ]);

        Cliente::create([
            'id_usuario' => $usuario->id_usuario,
            'tipo_documento' => $request->tipo_documento,
            'documento_identidad' => $request->documento_identidad,
            'licencia_conducir' => $request->licencia_conducir,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
        ]);

        return redirect()->route('clientes.index')->with('success', 'Cliente registrado exitosamente.');
    }

    public function edit($id)
    {
        $cliente = Cliente::with('usuario')->findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);
        $usuario = $cliente->usuario;

        $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|unique:usuarios,email,' . $usuario->id_usuario . ',id_usuario',
            'tipo_documento' => 'required|in:cedula,pasaporte',
            'documento_identidad' => 'required|string|unique:clientes,documento_identidad,' . $cliente->id_cliente . ',id_cliente',
            'licencia_conducir' => 'required|string',
            'telefono' => 'nullable|string|max:15',
            'direccion' => 'nullable|string|max:255',
        ]);

        // Actualizar usuario y cliente
        $usuario->update([
            'nombre' => $request->nombre,
            'email' => $request->email,
        ]);

        $cliente->update([
            'tipo_documento' => $request->tipo_documento,
            'documento_identidad' => $request->documento_identidad,
            'licencia_conducir' => $request->licencia_conducir,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
        ]);

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado exitosamente.');
    }
    public function showAutoCliente($id)
    {
        // Obtener el auto con las relaciones necesarias
        $auto = \App\Models\Auto::with(['marca', 'detalles', 'multimedia'])->findOrFail($id);

        // Cargar la vista correcta
        return view('clientes.show', compact('auto'));
    }

    public function search(Request $request)
    {
        // Crear una consulta base para los autos
        $query = \App\Models\Auto::with('marca', 'detalles');

        // Filtrar por marca
        if ($request->filled('marca')) {
            $query->whereHas('marca', function ($q) use ($request) {
                $q->where('nombre_marca', 'like', '%' . $request->marca . '%');
            });
        }

        // Filtrar por modelo
        if ($request->filled('modelo')) {
            $query->where('modelo', 'like', '%' . $request->modelo . '%');
        }

        // Filtrar por precio máximo
        if ($request->filled('precio_max')) {
            $query->where('precio_por_dia', '<=', $request->precio_max);
        }

        // Obtener los resultados de la búsqueda
        $autos = $query->get();

        // Retornar la vista con los resultados
        return view('clientes.search_results', compact('autos'));
    }



}

