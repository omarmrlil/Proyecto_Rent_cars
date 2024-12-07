<?php

namespace App\Http\Controllers;

use App\Models\Auto;
use App\Models\Cliente;
use App\Models\Alquiler;
use App\Models\Pago;
use App\Models\InventarioPieza;
use App\Models\Mantenimiento;
use App\Models\Empleado;
use App\Models\CajaMovimiento;
use App\Models\Notificacion;
use App\Models\MarcaAuto;
use App\Models\TipoAuto;
use App\Models\Usuario;
use App\Models\Reporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
    // Mostrar el panel de administración
    public function index()
    {
        // Definir las variables antes de usarlas
        $totalAutos = Auto::count();
        $totalClientes = Cliente::count();
        $alquileresActivos = Alquiler::where('estado', 'pendiente')->count();
        $ingresosTotales = Pago::sum('monto');

        // Datos adicionales para piezas e inventario
        $piezasDisponibles = InventarioPieza::where('cantidad_disponible', '>', 0)->get();

        $mantenimientosRecientes = Mantenimiento::with('empleado.usuario', 'auto')
        ->orderBy('fecha_mantenimiento', 'desc')
        ->limit(5)
        ->get();

        // Obtener datos para los gráficos
        $alquileresPorMes = Alquiler::selectRaw('MONTH(fecha_inicio) as mes, COUNT(*) as total')
            ->groupBy('mes')
            ->pluck('total', 'mes');

        $ingresosPorMes = Pago::selectRaw('MONTH(fecha_pago) as mes, SUM(monto) as total')
            ->groupBy('mes')
            ->pluck('total', 'mes');

        // Obtener los alquileres recientes con cliente y auto
        $alquileresRecientes = Alquiler::with(['cliente.usuario', 'auto'])
        ->orderBy('fecha_inicio', 'desc')
        ->limit(5)
        ->get();

        // Pasar todas las variables a la vista
        return view('admin.index', compact(
            'totalAutos',
            'totalClientes',
            'alquileresActivos',
            'ingresosTotales',
            'alquileresPorMes',
            'ingresosPorMes',
            'alquileresRecientes',
            'piezasDisponibles',
            'mantenimientosRecientes'
        ));
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

        // Crear los detalles del auto
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

        // Redirigir al listado de autos con mensaje de éxito
        return redirect()->route('admin.autos.index')->with('success', 'Auto registrado exitosamente.');
    }




    // Método para mostrar los alquileres
    public function alquileres()
    {
        // Obtener los alquileres con los datos relacionados (cliente y auto)
        $alquileres = Alquiler::with(['cliente.usuario', 'auto'])->orderBy('fecha_inicio', 'desc')->get();

        // Retornar a la vista de alquileres, pasando los datos necesarios
        return view('admin.alquileres', compact('alquileres'));
    } 
    public function storeAlquiler(Request $request)
    {
        $request->validate([
            'id_cliente' => 'required|exists:clientes,id_cliente',
            'id_auto' => 'required|exists:autos,id_auto',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'costo_total' => 'required|numeric|min:0',
        ]);

        // Crear el alquiler
        Alquiler::create([
            'id_cliente' => $request->id_cliente,
            'id_auto' => $request->id_auto,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'costo_total' => $request->costo_total,
            'estado' => 'pendiente',  // Estado inicial
        ]);

        return redirect()->route('admin.alquileres')->with('success', 'Alquiler registrado exitosamente.');
    }

    public function showAlquiler($id)
    {
        // Obtener el alquiler con sus datos relacionados
        $alquiler = Alquiler::with(['cliente', 'auto'])->findOrFail($id);

        // Retornar la vista con los detalles del alquiler
        return view('admin.showalquiler', compact('alquiler'));
    }

    public function editAlquiler($id)
    {
        // Obtener el alquiler con los datos relacionados
        $alquiler = Alquiler::findOrFail($id);

        // Obtener los clientes y autos disponibles para la edición
        $clientes = Cliente::all();
        $autos = Auto::all();

        // Retornar la vista de edición con los datos necesarios
        return view('admin.editalquiler', compact('alquiler', 'clientes', 'autos'));
    }

    public function updateAlquiler(Request $request, $id)
    {
        $request->validate([
            'id_cliente' => 'required|exists:clientes,id_cliente',
            'id_auto' => 'required|exists:autos,id_auto',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'costo_total' => 'required|numeric|min:0',
        ]);

        $alquiler = Alquiler::findOrFail($id);
        $alquiler->update([
            'id_cliente' => $request->id_cliente,
            'id_auto' => $request->id_auto,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'costo_total' => $request->costo_total,
        ]);

        return redirect()->route('admin.alquileres')->with('success', 'Alquiler actualizado exitosamente.');
    }

    public function deleteAlquiler($id)
    {
        $alquiler = Alquiler::findOrFail($id);
        $alquiler->delete();

        return redirect()->route('admin.alquileres')->with('success', 'Alquiler eliminado exitosamente.');
    }

    public function empleados()
    {
        // Obtener todos los empleados y sus datos relacionados
        $empleados = Empleado::with('usuario')->get();

        // Retornar a la vista de empleados
        return view('admin.empleados', compact('empleados'));
    }


    public function storeEmpleado(Request $request)
    {
        // Validar los datos
        $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|unique:usuarios,email',
            'cargo' => 'required|string|max:100',
            'fecha_contratacion' => 'required|date',
            'salario' => 'required|numeric|min:0',
        ]);

        // Establecer la contraseña por defecto si no se proporciona
        $password = $request->password ? bcrypt($request->password) : bcrypt('1234'); // Si no hay contraseña, asignar 1234

        // Crear el usuario
        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => $password, // Guardamos la contraseña
            'rol' => 'empleado', // Asignamos el rol de empleado
        ]);

        // Crear el empleado
        Empleado::create([
            'id_usuario' => $usuario->id_usuario,
            'cargo' => $request->cargo,
            'fecha_contratacion' => $request->fecha_contratacion,
            'salario' => $request->salario,
        ]);

        return redirect()->route('admin.empleados')->with('success', 'Empleado creado exitosamente.');
    }


    public function editEmpleado($id)
    {
        $empleado = Empleado::with('usuario')->findOrFail($id);
        return view('admin.editEmpleado', compact('empleado'));
    }

    public function updateEmpleado(Request $request, $id)
    {
        // Validar los datos
        $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:usuarios,email,' . $id . ',id_usuario', // Cambiado para usar id_usuario
            'cargo' => 'required|string|max:50',
            'fecha_contratacion' => 'required|date',
            'salario' => 'required|numeric|min:0',
        ]);

        // Obtener el empleado con su usuario relacionado
        $empleado = Empleado::with('usuario')->findOrFail($id);

        // Actualizar los datos del usuario
        $empleado->usuario->update([
            'nombre' => $request->nombre,
            'email' => $request->email,
        ]);

        // Actualizar los datos del empleado
        $empleado->update([
            'cargo' => $request->cargo,
            'fecha_contratacion' => $request->fecha_contratacion,
            'salario' => $request->salario,
        ]);

        // Redirigir al listado de empleados con un mensaje de éxito
        return redirect()->route('admin.empleados')->with('success', 'Empleado actualizado exitosamente.');
    }



    public function deleteEmpleado($id)
    {
        $empleado = Empleado::with('usuario')->findOrFail($id);
        $empleado->delete();
        $empleado->usuario->delete();  // Eliminar también el usuario relacionado

        return redirect()->route('admin.empleados')->with('success', 'Empleado eliminado exitosamente.');
    }
    public function createEmpleado()
    {
        // Aquí no necesitamos pasar datos, solo mostrar el formulario para crear un empleado
        return view('admin.createEmpleado');
    }


    public function inventarioPiezas()
    {
        $piezas = InventarioPieza::all();  // Obtener todas las piezas
        return view('admin.inventario', compact('piezas'));
    }

    public function createPieza()
    {
        return view('admin.createPieza');  // Vista para agregar una nueva pieza
    }

    public function storePieza(Request $request)
    {
        // Validar y crear la pieza
        $request->validate([
            'nombre_pieza' => 'required|string|max:100',
            'cantidad_disponible' => 'required|integer|min:0',
            'proveedor' => 'required|string|max:100',
            'costo_unidad' => 'required|numeric|min:0',
            'stock_minimo' => 'required|integer|min:0',
        ]);

        InventarioPieza::create($request->all());
        return redirect()->route('admin.inventarioPiezas')->with('success', 'Pieza agregada al inventario.');
    }

    public function editPieza($id)
    {
        $pieza = InventarioPieza::findOrFail($id);  // Obtener la pieza a editar
        return view('admin.editPieza', compact('pieza'));
    }

    public function updatePieza(Request $request, $id)
    {
        $request->validate([
            'nombre_pieza' => 'required|string|max:100',
            'cantidad_disponible' => 'required|integer|min:0',
            'proveedor' => 'required|string|max:100',
            'costo_unidad' => 'required|numeric|min:0',
            'stock_minimo' => 'required|integer|min:0',
        ]);

        $pieza = InventarioPieza::findOrFail($id);
        $pieza->update($request->all());

        return redirect()->route('admin.inventarioPiezas')->with('success', 'Pieza actualizada correctamente.');
    }

    public function deletePieza($id)
    {
        $pieza = InventarioPieza::findOrFail($id);
        $pieza->delete();

        return redirect()->route('admin.inventarioPiezas')->with('success', 'Pieza eliminada del inventario.');
    }



    public function mantenimientos()
    {
        $mantenimientos = Mantenimiento::with('auto', 'empleado')->orderBy('fecha_mantenimiento', 'desc')->get();
        return view('admin.mantenimientos', compact('mantenimientos'));
    }

    public function createMantenimiento()
    {
        $autos = Auto::all();
        $empleados = Empleado::all();
        return view('admin.createMantenimiento', compact('autos', 'empleados'));
    }

    public function storeMantenimiento(Request $request)
    {
        $request->validate([
            'id_auto' => 'required|exists:autos,id_auto',
            'fecha_mantenimiento' => 'required|date',
            'tipo_mantenimiento' => 'required|in:preventivo,correctivo',
            'descripcion' => 'required|string',
            'costo' => 'required|numeric|min:0',
            'kilometraje' => 'required|numeric|min:0',
            'realizado_por' => 'required|exists:empleados,id_empleado'
        ]);

        Mantenimiento::create($request->all());

        return redirect()->route('admin.mantenimientos')->with('success', 'Mantenimiento registrado exitosamente.');
    }

    public function editMantenimiento($id)
    {
        $mantenimiento = Mantenimiento::findOrFail($id);
        $autos = Auto::all();
        $empleados = Empleado::all();
        return view('admin.editMantenimiento',
            compact('mantenimiento', 'autos', 'empleados')
        );
    }

    public function updateMantenimiento(Request $request, $id)
    {
        $mantenimiento = Mantenimiento::findOrFail($id);

        $request->validate([
            'id_auto' => 'required|exists:autos,id_auto',
            'fecha_mantenimiento' => 'required|date',
            'tipo_mantenimiento' => 'required|in:preventivo,correctivo',
            'descripcion' => 'required|string',
            'costo' => 'required|numeric|min:0',
            'kilometraje' => 'required|numeric|min:0',
            'realizado_por' => 'required|exists:empleados,id_empleado'
        ]);

        $mantenimiento->update($request->all());

        return redirect()->route('admin.mantenimientos')->with('success', 'Mantenimiento actualizado exitosamente.');
    }

    public function deleteMantenimiento($id)
    {
        Mantenimiento::findOrFail($id)->delete();
        return redirect()->route('admin.mantenimientos')->with('success', 'Mantenimiento eliminado.');
    }

    public function addPiezasMantenimiento($id)
    {
        $mantenimiento = Mantenimiento::findOrFail($id);
        $piezas = InventarioPieza::all();
        return view('admin.addPiezasMantenimiento', compact('mantenimiento', 'piezas'));
    }

    public function storePiezasMantenimiento(Request $request, $id)
    {
        $request->validate([
            'id_pieza' => 'required|exists:inventario_piezas,id_pieza',
            'cantidad_utilizada' => 'required|numeric|min:1',
        ]);

        $mantenimiento = Mantenimiento::findOrFail($id);
        $mantenimiento->piezas()->create([
            'id_pieza' => $request->id_pieza,
            'cantidad_utilizada' => $request->cantidad_utilizada,
        ]);

        return redirect()->route('admin.mantenimientos')->with('success', 'Pieza registrada exitosamente.');
    }


    public function reportesFinancieros()
    {
        // Reporte de ingresos y egresos
        $ingresosTotales = Pago::sum('monto');
        $egresosTotales = CajaMovimiento::where('tipo', 'egreso')->sum('monto');

        // Ingresos por mes
        $ingresosPorMes = Pago::selectRaw('MONTH(fecha_pago) as mes, SUM(monto) as total')
            ->groupBy('mes')
            ->pluck('total', 'mes');

        // Egresos por mes
        $egresosPorMes = CajaMovimiento::selectRaw('MONTH(fecha_movimiento) as mes, SUM(monto) as total')
            ->groupBy('mes')
            ->pluck('total', 'mes');

        // Obtener todos los reportes generados
        $reportes = Reporte::all(); // O ajusta esta consulta según tus necesidades

        // Pasar todas las variables a la vista
        return view('admin.reportes_financieros', compact('ingresosTotales', 'egresosTotales', 'ingresosPorMes', 'egresosPorMes', 'reportes'));
    }

    public function generarReporte(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'tipo_reporte' => 'required|string',
        ]);

        // Crear el reporte
        $reporte = Reporte::create([
            'tipo_reporte' => $request->tipo_reporte,
            'estado_reporte' => 'generado',
            'fecha_generacion' => now(),
            'ruta_archivo' => 'ruta/del/reporte',  // Aquí puedes generar un archivo de reporte si es necesario
        ]);

        // Redirigir al administrador con mensaje de éxito
        return redirect()->route('admin.reportesFinancieros')->with('success', 'Reporte generado exitosamente');
    }


    public function descargarReporte($id)
    {
        // Buscar el reporte por id_reporte (no 'id')
        $reporte = Reporte::findOrFail($id);

        // Verificar si el archivo existe
        $rutaArchivo = public_path('reportes/' . $reporte->ruta_archivo);
        if (file_exists($rutaArchivo)) {
            // Descargar el archivo
            return response()->download($rutaArchivo);
        } else {
            // Si el archivo no existe
            return redirect()->route('admin.reportesFinancieros')->with('error', 'El reporte no está disponible.');
        }
    }



    // Mostrar las notificaciones recientes
    public function notificaciones()
    {
        $notificacionesRecientes = Notificacion::orderBy('fecha_creacion', 'desc')
            ->limit(5)
            ->get();

        return view('admin.notificaciones', compact('notificacionesRecientes'));
    }

    // Método para crear una nueva notificación
    public function createNotificacion()
    {
        $usuarios = Usuario::where('rol', 'cliente')->orWhere('rol', 'empleado')->get(); // Obtener todos los usuarios
        return view('admin.createNotificacion', compact('usuarios'));
    }

    // Método para almacenar la nueva notificación
    public function storeNotificacion(Request $request)
    {
        $request->validate([
            'id_usuario' => 'required|exists:usuarios,id_usuario',
            'tipo_notificacion' => 'required|string',
            'mensaje' => 'required|string',
        ]);

        Notificacion::create([
            'id_usuario' => $request->id_usuario,
            'tipo_notificacion' => $request->tipo_notificacion,
            'mensaje' => $request->mensaje,
            'estado' => 'pendiente', // El estado inicial será 'pendiente'
        ]);

        return redirect()->route('admin.notificaciones')->with('success', 'Notificación enviada exitosamente');
    }

    // Método para actualizar el estado de la notificación
    public function marcarComoEnviada($id)
    {
        $notificacion = Notificacion::findOrFail($id);
        $notificacion->update([
            'estado' => 'enviado',
            'fecha_envio' => now(),  // Fecha de envío actual
        ]);

        return redirect()->route('admin.notificaciones')->with('success', 'Notificación marcada como enviada');
    }


    // Mostrar la lista de clientes
    public function clientes()
    {
        $clientes = Cliente::with('usuario')->get();
        return view('admin.clientes', compact('clientes'));
    }

    // Editar la información de un cliente
    public function editCliente($id)
    {
        $cliente = Cliente::with('usuario')->findOrFail($id);
        return view('admin.editCliente', compact('cliente'));
    }

    // Actualizar la información de un cliente
    public function updateCliente(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:usuarios,email,' . $id,
            'telefono' => 'nullable|string|max:15',
            'direccion' => 'nullable|string|max:255',
        ]);

        // Actualizar usuario y cliente
        $cliente = Cliente::with('usuario')->findOrFail($id);
        $cliente->usuario->update([
            'nombre' => $request->nombre,
            'email' => $request->email,
        ]);
        $cliente->update([
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
        ]);

        return redirect()->route('admin.clientes')->with('success', 'Cliente actualizado correctamente');
    }

    // Eliminar un cliente
    public function deleteCliente($id)
    {
        $cliente = Cliente::with('usuario')->findOrFail($id);
        $cliente->delete();
        $cliente->usuario->delete(); // Eliminar también el usuario relacionado

        return redirect()->route('admin.clientes')->with('success', 'Cliente eliminado correctamente');
    }

    // Mostrar calendario de alquileres
    public function calendarioAlquileres()
    {
        $alquileres = Alquiler::select('fecha_inicio', 'fecha_fin', 'id_auto')
        ->get()
        ->map(function ($alquiler) {
            // Asegurarse de que las fechas estén como instancias de Carbon
            $alquiler->fecha_inicio = \Carbon\Carbon::parse($alquiler->fecha_inicio);
            $alquiler->fecha_fin = \Carbon\Carbon::parse($alquiler->fecha_fin);
            return $alquiler;
        });

        return view('admin.calendarioAlquileres',
            compact('alquileres')
        );
    }

    // Mostrar calendario de mantenimientos
    public function calendarioMantenimientos()
    {
        $mantenimientos = Mantenimiento::select('fecha_mantenimiento', 'id_auto')->get();
        return view('admin.calendarioMantenimientos', compact('mantenimientos'));
    }


    public function autos()
    {
        $autos = Auto::all();
        return view('admin.autos', compact('autos'));
    }

    // Mostrar el formulario para crear un auto
    public function createAuto()
    {
        $marcas = MarcaAuto::all();
        $tipos = TipoAuto::all();
        return view('admin.createAuto', compact('marcas', 'tipos'));
    }

    // Almacenar un nuevo auto
    public function storeAuto(Request $request)
    {
        // Validación de los datos del formulario
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

        // Obtener todos los datos del request
        $data = $request->all();

        // Subir la foto si es proporcionada
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

        // Redirigir al listado de autos con un mensaje de éxito
        return redirect()->route('admin.autos')->with('success', 'Auto y sus detalles registrados exitosamente.');
    }

    // Mostrar el formulario de edición de un auto
    public function editAuto($id)
    {
        $auto = Auto::findOrFail($id);
        $marcas = MarcaAuto::all();
        $tipos = TipoAuto::all();
        return view('admin.editAuto', compact('auto', 'marcas', 'tipos'));
    }

    // Actualizar un auto
    public function updateAuto(Request $request, $id)
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


        return redirect()->route('admin.autos')->with('success', 'Auto actualizado exitosamente.');
    }

}
