<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\AutoController;
use App\Http\Controllers\AlquilerController;
use App\Http\Controllers\MantenimientoController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TareaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Auth;

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login'); // Redirige al login después de cerrar sesión
})->name('logout');


// Página de inicio
Route::get('/', function () {
    return view('index');
})->name('home');

// Rutas para Usuarios
Route::resource('usuarios', UsuarioController::class);

// Rutas para Clientes
Route::resource('clientes', ClienteController::class);

// Rutas para Empleados
Route::resource('empleados', EmpleadoController::class);

// Rutas para Autos
Route::resource('autos', AutoController::class);

// Rutas para Alquileres
Route::resource('alquileres', AlquilerController::class);

// Rutas para Mantenimientos
Route::resource('mantenimientos', MantenimientoController::class);

// Rutas para Inventario
Route::resource('inventarios', InventarioController::class);

// Rutas para Pagos
Route::resource('pagos', PagoController::class);

// Rutas para Facturas
Route::resource('facturas', FacturaController::class);

// Rutas para Notificaciones
Route::resource('notificaciones', NotificacionController::class);

// Rutas para Reportes
Route::resource('reportes', ReporteController::class);

Route::get('reportes', [ReporteController::class, 'index'])->name('reportes.index');
Route::post('reportes/generar', [ReporteController::class, 'generar'])->name('reportes.generar');

Route::get('notificaciones/mis-notificaciones', [NotificacionController::class, 'misNotificaciones'])->name('notificaciones.mis');

Route::post('notificaciones/{id}/marcar-visto', [NotificacionController::class, 'marcarVisto'])->name('notificaciones.marcarVisto');

Route::get('/search_vehicles', [AutoController::class, 'search'])->name('search_vehicles');
Route::get('/autos', [AutoController::class, 'index'])->name('autos.index');
Route::get('/autos/{id}', [AutoController::class, 'show'])->name('autos.show');



Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [UsuarioController::class, 'showRegisterForm'])->name('register');
Route::post('register', [UsuarioController::class, 'register']);

// Grupo de rutas para el panel de administración con middleware `auth` y `admin`
Route::middleware(['role:administrador'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Rutas de gestión de empleados
    Route::get('empleados', [AdminController::class, 'empleados'])->name('empleados');
    Route::get('empleados/crear', [AdminController::class, 'createEmpleado'])->name('empleados.create');
    Route::post('empleados', [AdminController::class, 'storeEmpleado'])->name('empleados.store');
    Route::get('empleados/{id}/editar', [AdminController::class, 'editEmpleado'])->name('empleados.edit');
    Route::put('empleados/{id}', [AdminController::class, 'updateEmpleado'])->name('empleados.update');
    Route::delete('empleados/{id}', [AdminController::class, 'deleteEmpleado'])->name('empleados.delete');

    // Rutas de gestión de autos
    Route::get('autos', [AdminController::class, 'autos'])->name('autos');
    Route::get('autos', [AdminController::class, 'createAuto'])->name('autos'); // Ruta para mostrar el formulario de creación de autos
    Route::post('autos', [AdminController::class, 'store'])->name('autos.store'); // Ruta para almacenar un auto

    // Rutas de alquileres
    Route::get('alquileres', [AdminController::class, 'alquileres'])->name('alquileres'); // Lista de alquileres
    Route::get('alquileres/{alquiler}', [AdminController::class, 'showAlquiler'])->name('showAlquiler'); // Mostrar detalles de un alquiler
    Route::post('alquileres/store', [AdminController::class, 'storeAlquiler'])->name('storeAlquiler'); // Almacenar un alquiler
    // Ruta para editar alquiler
    Route::get('alquileres/{alquiler}/edit', [AdminController::class, 'editAlquiler'])->name('editAlquiler');

    // Ruta para actualizar alquiler
    Route::put('alquileres/{alquiler}', [AdminController::class, 'updateAlquiler'])->name('updateAlquiler');

    // Ruta para eliminar alquiler
    Route::delete('alquileres/{alquiler}', [AdminController::class, 'deleteAlquiler'])->name('deleteAlquiler');


    // Rutas de gestión de inventario de piezas
    Route::get('inventario-piezas', [AdminController::class, 'inventarioPiezas'])->name('inventarioPiezas');
    Route::get('inventario-piezas/crear', [AdminController::class, 'createPieza'])->name('createPieza');
    Route::post('inventario-piezas/crear', [AdminController::class, 'storePieza'])->name('storePieza');
    Route::get('inventario-piezas/{pieza}/editar', [AdminController::class, 'editPieza'])->name('editPieza');
    Route::put('inventario-piezas/{pieza}', [AdminController::class, 'updatePieza'])->name('updatePieza');
    Route::delete('inventario-piezas/{pieza}', [AdminController::class, 'deletePieza'])->name('deletePieza');

    // Rutas de gestión de mantenimiento
    Route::get('mantenimientos', [AdminController::class, 'mantenimientos'])->name('mantenimientos');
    Route::get('mantenimientos/crear', [AdminController::class, 'createMantenimiento'])->name('createMantenimiento');
    Route::post('mantenimientos', [AdminController::class, 'storeMantenimiento'])->name('storeMantenimiento');
    Route::get('mantenimientos/{mantenimiento}/editar', [AdminController::class, 'editMantenimiento'])->name('editMantenimiento');
    Route::put('mantenimientos/{mantenimiento}', [AdminController::class, 'updateMantenimiento'])->name('updateMantenimiento');
    Route::delete('mantenimientos/{mantenimiento}', [AdminController::class, 'deleteMantenimiento'])->name('deleteMantenimiento');

    // Rutas de gestión de piezas usadas en mantenimiento
    Route::get('mantenimientos/{mantenimiento}/piezas', [AdminController::class, 'addPiezasMantenimiento'])->name('addPiezasMantenimiento');
    Route::post('mantenimientos/{mantenimiento}/piezas', [AdminController::class, 'storePiezasMantenimiento'])->name('storePiezasMantenimiento');


    Route::get('reportes-financieros', [AdminController::class, 'reportesFinancieros'])->name('reportesFinancieros');
    Route::post('reportes-generar', [AdminController::class, 'generarReporte'])->name('generarReporte');
    Route::get('reportes/{id}/descargar', [AdminController::class, 'descargarReporte'])->name('descargarReporte');

    // Ver las notificaciones recientes
    Route::get('notificaciones', [AdminController::class, 'notificaciones'])->name('notificaciones');
    Route::get('notificaciones', [AdminController::class, 'notificaciones'])->name('notificaciones');

    // Crear nueva notificación
    Route::get('notificaciones/crear', [AdminController::class, 'createNotificacion'])->name('createNotificacion');
    Route::post('notificaciones', [AdminController::class, 'storeNotificacion'])->name('storeNotificacion');

    // Marcar notificación como enviada
    Route::get('notificaciones/{id}/marcar-enviada', [AdminController::class, 'marcarComoEnviada'])->name('marcarNotificacionEnviada');


    // Rutas para la gestión de clientes
    Route::get('clientes', [AdminController::class, 'clientes'])->name('clientes');
    Route::get('clientes/{id}/editar', [AdminController::class, 'editCliente'])->name('clientes.edit');
    Route::put('clientes/{id}', [AdminController::class, 'updateCliente'])->name('clientes.update');
    Route::delete('clientes/{id}', [AdminController::class, 'deleteCliente'])->name('clientes.delete');

    // Rutas para los calendarios de alquileres y mantenimientos
    Route::get('calendarios/alquileres', [AdminController::class, 'calendarioAlquileres'])->name('calendarioAlquileres');
    Route::get('calendarios/mantenimientos', [AdminController::class, 'calendarioMantenimientos'])->name('calendarioMantenimientos');


});

// Rutas protegidas para los clientes
Route::middleware(['role:cliente'])->prefix('cliente')->name('cliente.')->group(function () {
    Route::get('dashboard', [ClienteController::class, 'index'])->name('dashboard');
    Route::get('autos', [ClienteController::class, 'autos'])->name('autos');
    Route::get('servicios', [ClienteController::class, 'servicios'])->name('servicios');
    Route::get('contact', [ClienteController::class, 'contact'])->name('contact');
    Route::get('autos/{id}', [ClienteController::class, 'showAutoCliente'])->name('autos.show');
    Route::get('/search', [ClienteController::class, 'search'])->name('search');

    // Mi Cuenta
    Route::get('mi-cuenta', [ClienteController::class, 'miCuenta'])->name('mi_cuenta');
    Route::post('update-profile', [ClienteController::class, 'updateProfile'])->name('updateProfile');
    Route::post('update-password', [ClienteController::class, 'updatePassword'])->name('updatePassword');

    Route::post('cliente/facturas/{id}/pagar', [ClienteController::class, 'pagarFactura'])->name('pagarFactura');

    Route::post('cliente/autos/{id}/reservar', [ClienteController::class, 'reservarAuto'])->name('autos.reservar');
    Route::get('autos', [ClienteController::class, 'autos'])->name('autos');
    Route::get('cliente/autos/{id}/alquiler', [ClienteController::class, 'mostrarFormularioAlquiler'])->name('autos.alquiler');
    Route::post('cliente/autos/{id}/alquiler', [ClienteController::class, 'procesarAlquiler'])->name('autos.procesar_alquiler');

    Route::get('cliente/facturas', [ClienteController::class, 'listarFacturas'])->name('facturas');
    Route::get('cliente/facturas/{id}/pdf', [ClienteController::class, 'descargarFacturaPDF'])->name('factura.pdf');
    Route::get('cliente/factura/{id}', [ClienteController::class, 'verFactura'])->name('factura');
    Route::get('cliente/mis-alquileres', [ClienteController::class, 'misAlquileres'])->name('mis_alquileres');
    Route::get('/cliente/alquileres/{id}/detalles', [ClienteController::class, 'detallesAlquiler'])->name('detallesAlquiler');
    Route::post('/cliente/alquileres/{id}/cancelar', [ClienteController::class, 'cancelarAlquiler'])->name('cancelarAlquiler');
    Route::get('/cliente/mis-alquileres', [ClienteController::class, 'listarAlquileres'])->name('mis_alquileres');


    Route::get('historial-pagos', [ClienteController::class, 'historialPagos'])->name('historial_pagos');

    // historial
    Route::get('historial', [ClienteController::class, 'historial'])->name('historial');

    // Notificaciones
    Route::get('notificaciones', [ClienteController::class, 'getNotificaciones'])->name('notificaciones');

    Route::get('cliente/autos/{id}/alquiler', [ClienteController::class, 'mostrarFormularioAlquiler'])->name('autos.alquiler');


});



// Rutas protegidas por middleware `empleado` para el Dashboard del Empleado
Route::middleware([ 'role:empleado'])->prefix('empleado')->name('empleado.')->group(function () {
    Route::get('dashboard', [EmpleadoController::class, 'index'])->name('dashboard');
    Route::get('index', [EmpleadoController::class, 'index'])->name('index');
    Route::get('mantenimientos', [EmpleadoController::class, 'mantenimientos'])->name('mantenimientos');
    Route::get('mantenimientos/{id}/detalles', [EmpleadoController::class, 'detallesMantenimiento'])->name('mantenimientos.detalles');
    Route::post('mantenimientos/{id}/finalizar', [EmpleadoController::class, 'finalizarMantenimiento'])->name('mantenimientos.finalizar');
    Route::get('mantenimientos/{id}/editar', [EmpleadoController::class, 'editarMantenimiento'])->name('mantenimientos.editar');
    Route::put('mantenimientos/{id}', [EmpleadoController::class, 'actualizarMantenimiento'])->name('mantenimientos.actualizar');
    Route::delete('mantenimientos/{id}', [EmpleadoController::class, 'eliminarMantenimiento'])->name('mantenimientos.eliminar');
    Route::get('notificaciones', [EmpleadoController::class, 'notificaciones'])->name('notificaciones');
    Route::post('notificaciones/{id}/visto', [EmpleadoController::class, 'marcarComoVista'])->name('notificaciones.visto');
    Route::get('perfil', [EmpleadoController::class, 'perfil'])->name('perfil');
    Route::post('perfil/actualizar', [EmpleadoController::class, 'actualizarPerfil'])->name('perfil.actualizar');
    Route::post('perfil/cambiar-password', [EmpleadoController::class, 'cambiarPassword'])->name('perfil.cambiar_password');
    Route::get('estadisticas', [EmpleadoController::class, 'estadisticas'])->name('estadisticas');
    Route::get('tareas', [EmpleadoController::class, 'tareas'])->name('tareas');
    Route::get('/tareas', [EmpleadoController::class, 'tareas'])->name('tareas');
    Route::post('tareas/{id}/estado', [EmpleadoController::class, 'actualizarEstadoTarea'])->name('tareas.estado');
    Route::resource('empleados', EmpleadoController::class)->except(['show']);
});



Route::get('/servicios', function () {
    return view('services');
})->name('services');

Route::get('/contacto', function () {
    return view('contact');
})->name('contact');



