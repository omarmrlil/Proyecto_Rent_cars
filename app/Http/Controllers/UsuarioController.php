<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    // Método para listar todos los usuarios
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuarios.index', compact('usuarios'));
    }

    public function destroy($id)
    {
        $usuarios = Usuario::findOrFail($id);
        $usuarios->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado exitosamente.');
    }

    public function showRegisterForm()
    {
        return view('register');
    }

    // Manejar el registro de nuevos usuarios y clientes
    public function register(Request $request)
    {
        // Validar los datos de usuario y cliente
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|string|min:6|confirmed',
            'tipo_documento' => 'required|in:cedula,pasaporte',
            'documento_identidad' => 'required|string|max:50|unique:clientes,documento_identidad',
            'licencia_conducir' => 'required|string|max:50',
            'telefono' => 'nullable|string|max:15',
            'direccion' => 'nullable|string|max:255',
        ]);

        // Crear el usuario
        $usuario = usuario::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => 'cliente',
            'estado' => 'activo',
        ]);

        // Crear el cliente asociado al usuario
        $usuario->cliente()->create([
            'tipo_documento' => $request->tipo_documento,
            'documento_identidad' => $request->documento_identidad,
            'licencia_conducir' => $request->licencia_conducir,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
        ]);

        // Iniciar sesión automáticamente después del registro
        Auth::loginUsingId($usuario->id_usuario); // Usar el ID del usuario para iniciar sesión

        // Redirigir al dashboard del cliente
        return redirect()->route('cliente.dashboard')->with('success', 'Registro completado exitosamente.');
    }
}
