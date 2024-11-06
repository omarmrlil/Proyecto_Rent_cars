<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ClienteController extends Controller
{
    public function index()
    {
        // Obtener el cliente autenticado
        $usuario = Auth::user();
        $clientes = Cliente::with('usuario')->get();
        return view('clientes.index', compact('clientes', 'usuario'));
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
}
