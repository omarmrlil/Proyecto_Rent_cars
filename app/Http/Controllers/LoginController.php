<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Usuario;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        $usuario = Usuario::where('email', $request->email)->with('cliente')->first();
        $usuario = DB::table('usuarios')->where('email', $request->email)->first();

        if ($usuario && $request->password === $usuario->password) {
            // Almacena el usuario en la sesión manualmente
            session(['usuario' => $usuario]);

            // Verificar si el usuario se ha almacenado en la sesión
            if (session()->has('usuario')) {
                // Redirigir según el rol del usuario
                switch ($usuario->rol) {
                    case 'cliente':
                        return redirect()->route('cliente.dashboard');
                    case 'empleado':
                        return redirect()->route('empleado.dashboard');
                    case 'administrador':
                        return redirect()->route('admin.index');
                    default:
                        return redirect()->route('home');
                }
            } else {
                return back()->withErrors([
                    'email' => 'No se pudo guardar la sesión. Inténtalo de nuevo.',
                ]);
            }
        } else {
            return back()->withErrors([
                'email' => 'Credenciales incorrectas.',
            ]);
        }
    }

    public function logout()
    {
        // Elimina el usuario de la sesión
        Session::forget('usuario');
        Session::flush();

        return redirect()->route('login')->with('message', 'Sesión cerrada exitosamente.');
    }
}
