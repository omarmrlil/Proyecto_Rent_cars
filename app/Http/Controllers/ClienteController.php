<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Usuario;
use App\Models\Alquiler;
use App\Models\Notificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Pago;
use App\Models\Factura;

class ClienteController extends Controller
{
    /**
     * Mostrar el dashboard del cliente.
     */
    public function index()
    {
        $usuario = Auth::user();
        return view('clientes.index', compact('usuario'));

        $usuarioId = session('usuario_id'); // Obtener el ID del usuario desde la sesión

        if (!$usuarioId) {
            return redirect()->route('login')->withErrors('Por favor, inicia sesión.');
        }

        $usuario = Usuario::with('cliente')->find($usuarioId);

        if (!$usuario || !$usuario->cliente) {
            abort(404, 'No se encontró información del cliente.');
        }

        $clientes = Cliente::with('usuario')->get();
        return view('clientes.index', compact('clientes', 'usuario'));
    }

    /**
     * Mostrar información detallada de un cliente.
     */
    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Mostrar los autos disponibles para el cliente.
     */
    public function autos()
    {
        $autos = \App\Models\Auto::with(['marca', 'detalles'])->get();
        return view('clientes.autos', compact('autos'));
    }

    /**
     * Mostrar los servicios disponibles para el cliente.
     */
    public function servicios()
    {
        return view('clientes.servicios');
    }

    /**
     * Mostrar la página de contacto para el cliente.
     */
    public function contact()
    {
        return view('clientes.contact');
    }

    /**
     * Mostrar el formulario para registrar un nuevo cliente.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Almacenar un nuevo cliente en la base de datos.
     */
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

    /**
     * Mostrar el formulario para editar un cliente.
     */
    public function edit($id)
    {
        $cliente = Cliente::with('usuario')->findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Actualizar la información de un cliente en la base de datos.
     */
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

    /**
     * Eliminar un cliente de la base de datos.
     */
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado exitosamente.');
    }

    /**
     * Mostrar un auto en detalle.
     */
    public function showAutoCliente($id)
    {
        $auto = \App\Models\Auto::with(['marca', 'detalles', 'multimedia'])->findOrFail($id);
        return view('clientes.show', compact('auto'));
    }

    /**
     * Buscar autos según criterios del cliente.
     */
    public function search(Request $request)
    {
        $query = \App\Models\Auto::with('marca', 'detalles');

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

        return view('clientes.search_results', compact('autos'));
    }

    /**
     * Mostrar las notificaciones del cliente.
     */
    public function getNotificaciones()
    {
        $usuario = session('usuario'); // Obtenemos el usuario de la sesión

        if (!$usuario) {
            return redirect()->route('login')->withErrors('Por favor, inicia sesión.');
        }

        // Consultar las notificaciones del usuario
        $notificaciones = Notificacion::where('id_usuario', $usuario->id_usuario)
            ->orderBy('fecha_creacion', 'desc')
            ->get();

        // Retornar la vista con las notificaciones
        return view('clientes.notificaciones', compact('notificaciones', 'usuario'));
    }

    /**
     * Mostrar la página "Mi Cuenta" del cliente.
     */
    public function miCuenta()
    {
        $usuario = session('usuario');
        return view('clientes.mi_cuenta', compact('usuario'));

        $usuarioId = session('usuario_id');

    }

    /**
     * Actualizar el perfil del cliente.
     */
    public function updateProfile(Request $request)
    {
        // Validar los datos ingresados
        $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|unique:usuarios,email,' . session('usuario')->id_usuario . ',id_usuario',
            'telefono' => 'nullable|string|max:15',
            'direccion' => 'nullable|string|max:255',
        ]);

        // Obtener el usuario de la sesión
        $usuario = session('usuario');

        // Actualizar datos del usuario
        DB::table('usuarios')->where('id_usuario', $usuario->id_usuario)->update([
            'nombre' => $request->nombre,
            'email' => $request->email,
        ]);

        // Actualizar datos del cliente
        DB::table('clientes')->where('id_usuario', $usuario->id_usuario)->update([
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
        ]);

        // Actualizar la sesión
        $usuario->nombre = $request->nombre;
        $usuario->email = $request->email;
        session(['usuario' => $usuario]);

        return back()->with('success', 'Perfil actualizado correctamente.');
    }

    /**
     * Cambiar la contraseña del cliente.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $usuario = session('usuario'); // Obtener el usuario desde la sesión

        if ($request->current_password !== $usuario->password) {
            return back()->withErrors(['current_password' => 'La contraseña actual no es correcta.']);
        }

        // Actualiza la contraseña en la base de datos
        DB::table('usuarios')
        ->where('id_usuario', $usuario->id_usuario)
            ->update(['password' => bcrypt($request->new_password)]);

        // Actualiza la contraseña en la sesión
        $usuario->password = bcrypt($request->new_password);
        session(['usuario' => $usuario]);

        return back()->with('success', 'Contraseña actualizada exitosamente.');
    }



    /**
     * Mostrar el historial de alquileres del cliente.
     */
    public function historialAlquileres()
    {
        $usuarioId = session('usuario_id');

        if (!$usuarioId) {
            return redirect()->route('login')->withErrors('Por favor, inicia sesión.');
        }

        $alquileres = Alquiler::whereHas('cliente', function ($query) use ($usuarioId) {
            $query->where('id_usuario', $usuarioId);
        })->with('auto.marca', 'auto.detalles')->get();

        return view('clientes.historial', compact('alquileres'));
    }

    /**
     * Listar métodos de pago del cliente.
     */



    /**
     * Marcar una notificación como vista.
     */
    public function marcarNotificacionVista($id)
    {
        $usuarioId = session('usuario_id');
        $notificacion = Notificacion::where('id_usuario', $usuarioId)->findOrFail($id);

        $notificacion->update(['estado' => 'visto']);
        return back()->with('success', 'Notificación marcada como vista.');
    }

    public function eliminarNotificacion($id)
    {
        $usuarioId = session('usuario_id');
        $notificacion = Notificacion::where('id_usuario', $usuarioId)->findOrFail($id);

        $notificacion->delete();
        return back()->with('success', 'Notificación eliminada exitosamente.');
    }


    public function listarMetodosPago()
    {
        $usuario = session('usuario'); // Usuario autenticado en la sesión

        if (!$usuario) {
            return redirect()->route('login')->withErrors('Por favor, inicia sesión.');
        }

        // Obtener todos los métodos de pago del cliente
        $pagos = Pago::whereHas('alquiler.cliente', function ($query) use ($usuario) {
            $query->where('id_usuario', $usuario->id_usuario);
        })->get();

        return view('clientes.metodos_pago', compact('pagos', 'usuario'));
    }

    public function agregarMetodoPago(Request $request)
    {
        $usuario = session('usuario'); // Usuario autenticado en la sesión

        if (!$usuario) {
            return redirect()->route('login')->withErrors('Por favor, inicia sesión.');
        }

        $request->validate([
            'metodo_pago' => 'required|in:tarjeta_credito,tarjeta_debito,paypal',
            'referencia_transaccion' => 'nullable|string|max:100',
        ]);

        // Crear un método de pago genérico asociado al cliente
        Pago::create([
            'id_alquiler' => null, // Esto puede ser opcional si no está asociado a un alquiler
            'monto' => 0, // Inicialmente cero
            'metodo_pago' => $request->metodo_pago,
            'referencia_transaccion' => $request->referencia_transaccion,
            'fecha_pago' => now(),
        ]);

        return back()->with('success', 'Método de pago agregado correctamente.');
    }

    public function eliminarMetodoPago($id)
    {
        $usuario = session('usuario'); // Usuario autenticado en la sesión

        if (!$usuario) {
            return redirect()->route('login')->withErrors('Por favor, inicia sesión.');
        }

        $pago = Pago::whereHas('alquiler.cliente', function ($query) use ($usuario) {
            $query->where('id_usuario', $usuario->id_usuario);
        })->findOrFail($id);

        $pago->delete();

        return back()->with('success', 'Método de pago eliminado correctamente.');
    }

    public function reservarAuto(Request $request, $id)
    {
        $usuario = session('usuario'); // Obtenemos el usuario desde la sesión

        // Validar datos del formulario
        $request->validate([
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'fecha_fin' => 'required|date|after:fecha_inicio',
        ]);

        // Obtener el cliente relacionado
        $cliente = Cliente::where('id_usuario', $usuario->id_usuario)->first();

        if (!$cliente) {
            return redirect()->route('cliente.autos')->withErrors('No se encontró información del cliente.');
        }

        // Obtener el auto seleccionado
        $auto = \App\Models\Auto::find($id);

        if (!$auto) {
            return redirect()->route('cliente.autos')->withErrors('El auto seleccionado no existe.');
        }

        // Verificar si el auto está disponible
        if ($auto->estado !== 'disponible') {
            return redirect()->route('cliente.autos')->withErrors('El auto seleccionado no está disponible.');
        }

        // Calcular el costo total
        $dias = $request->fecha_inicio->diffInDays($request->fecha_fin);
        $costoTotal = $dias * $auto->precio_por_dia;

        // Registrar el alquiler
        Alquiler::create([
            'id_cliente' => $cliente->id_cliente,
            'id_auto' => $id,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'costo_total' => $costoTotal,
        ]);

        // Cambiar el estado del auto a "alquilado"
        $auto->update(['estado' => 'alquilado']);

        return redirect()->route('cliente.autos')->with('success', 'Auto reservado exitosamente.');
    }



    public function misAlquileres()
    {
        $usuario = session('usuario'); // Obtenemos el usuario desde la sesión

        if (!$usuario) {
            return redirect()->route('login')->withErrors('Por favor, inicia sesión.');
        }

        // Consultar el cliente asociado al usuario
        $cliente = Cliente::where('id_usuario', $usuario->id_usuario)->first();

        if (!$cliente) {
            abort(404, 'Cliente no encontrado.');
        }

        // Obtener los alquileres del cliente
        $alquileres = Alquiler::where('id_cliente', $cliente->id_cliente)
            ->with(['auto.marca', 'auto.detalles']) // Cargar relaciones necesarias
            ->orderBy('fecha_inicio', 'desc')
            ->get();

        // Retornar la vista con los alquileres
        return view('clientes.mis_alquileres', compact('alquileres', 'usuario'));
    }
    public function verFactura($id)
    {
        $factura = Factura::where('id_alquiler', $id)->firstOrFail();
        return view('clientes.factura', compact('factura'));
    }
    public function mostrarFormularioAlquiler($id)
    {
        $usuario = session('usuario'); // Obtenemos el usuario desde la sesión

        // Verificar que el usuario esté autenticado
        if (!$usuario) {
            return redirect()->route('login')->withErrors('Por favor, inicia sesión.');
        }

        // Obtener el auto y las fechas de alquiler existentes
        $auto = \App\Models\Auto::with('marca', 'detalles')->find($id);
        $alquileres = \App\Models\Alquiler::where('id_auto', $id)
            ->whereIn('estado', ['pendiente', 'alquilado'])
            ->get();

        if (!$auto) {
            return redirect()->route('cliente.autos')->withErrors('El auto seleccionado no existe.');
        }

        return view('clientes.alquiler', compact('auto', 'alquileres', 'usuario'));
    }
    public function procesarAlquiler(Request $request, $id)
    {
        $usuario = session('usuario'); // Obtener el usuario desde la sesión

        $request->validate([
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'metodo_pago' => 'required|string',
        ]);

        // Obtener el cliente y validar su existencia
        $cliente = Cliente::where('id_usuario', $usuario->id_usuario)->first();

        if (!$cliente) {
            return redirect()->route('cliente.autos')->withErrors('No se encontró información del cliente.');
        }

        // Obtener el auto y validar disponibilidad
        $auto = \App\Models\Auto::find($id);

        if (!$auto || $auto->estado !== 'disponible') {
            return redirect()->route('cliente.autos')->withErrors('El auto seleccionado no está disponible.');
        }

        // Verificar si las fechas no están ocupadas
        $conflictos = \App\Models\Alquiler::where('id_auto', $id)
            ->where('estado', '!=', 'completado')
            ->where(function ($query) use ($request) {
                $query->whereBetween('fecha_inicio', [$request->fecha_inicio, $request->fecha_fin])
                    ->orWhereBetween('fecha_fin', [$request->fecha_inicio, $request->fecha_fin])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('fecha_inicio', '<=', $request->fecha_inicio)
                            ->where('fecha_fin', '>=', $request->fecha_fin);
                    });
            })->exists();

        if ($conflictos) {
            return redirect()->back()->withErrors('El auto no está disponible en las fechas seleccionadas.');
        }

        // Calcular el costo total
        $dias = \Carbon\Carbon::parse($request->fecha_inicio)->diffInDays(\Carbon\Carbon::parse($request->fecha_fin));
        $costoTotal = $dias * $auto->precio_por_dia;

        // Registrar el alquiler
        $alquiler = \App\Models\Alquiler::create([
            'id_cliente' => $cliente->id_cliente,
            'id_auto' => $id,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'costo_total' => $costoTotal,
            'estado' => 'pendiente',
        ]);

        // Crear el registro del pago
        \App\Models\Pago::create([
            'id_alquiler' => $alquiler->id_alquiler,
            'monto' => $costoTotal,
            'metodo_pago' => $request->metodo_pago,
            'referencia_transaccion' => 'TXN-' . uniqid(),
        ]);

        // Crear la factura
        \App\Models\Factura::create([
            'id_alquiler' => $alquiler->id_alquiler,
            'numero_factura' => 'FAC-' . strtoupper(uniqid()),
            'monto_total' => $costoTotal,
            'monto_impuesto' => $costoTotal * 0.18, // ITBIS 18%
        ]);

        // Cambiar el estado del auto
        $auto->update(['estado' => 'alquilado']);

        return redirect()->route('cliente.autos')->with('success', 'Auto reservado exitosamente.');
    }


}
