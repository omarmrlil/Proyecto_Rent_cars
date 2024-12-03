<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        $usuario = session('usuario');

        if (!$usuario) {
            return redirect()->route('login')->withErrors(['auth' => 'Debe iniciar sesión para acceder.']);
        }

        if ($usuario->rol !== $role) {
            return response()->json(['error' => 'Acceso denegado: Rol incorrecto.'], 403);
        }

        return $next($request);
    }
}
