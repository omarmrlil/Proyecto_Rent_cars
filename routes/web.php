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



Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [UsuarioController::class, 'showRegisterForm'])->name('register');
Route::post('register', [UsuarioController::class, 'register']);

// Grupo de rutas para el panel de administración con middleware `auth` y `admin`
Route::middleware(['role:administrador'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('empleados', [AdminController::class, 'empleados'])->name('empleados');
    Route::get('inventario-piezas', [AdminController::class, 'inventarioPiezas'])->name('inventarioPiezas');
    Route::get('mantenimientos', [AdminController::class, 'historialMantenimientos'])->name('historialMantenimientos');
    Route::get('reportes-financieros', [AdminController::class, 'reportesFinancieros'])->name('reportesFinancieros');
    Route::get('notificaciones', [AdminController::class, 'notificaciones'])->name('notificaciones');
});

// Rutas protegidas por middleware `cliente` para el Dashboard del Cliente
Route::middleware(['role:cliente'])->prefix('cliente')->name('cliente.')->group(function () {
    Route::get('dashboard', [ClienteController::class, 'index'])->name('dashboard');
    Route::get('perfil', [ClienteController::class, 'perfil'])->name('perfil');
    Route::get('alquileres', [ClienteController::class, 'alquileres'])->name('alquileres');
    Route::post('alquileres/reservar', [ClienteController::class, 'reservar'])->name('reservar');
});

// Rutas protegidas por middleware `empleado` para el Dashboard del Empleado
Route::middleware([ 'role:empleado'])->prefix('empleado')->name('empleado.')->group(function () {
    Route::get('dashboard', [EmpleadoController::class, 'index'])->name('dashboard');
    Route::get('mantenimientos', [MantenimientoController::class, 'index'])->name('mantenimientos.index');
    Route::get('perfil', [EmpleadoController::class, 'perfil'])->name('perfil');
});


