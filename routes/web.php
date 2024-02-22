<?php

use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\CancelacionController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\ObjetoController;
use App\Http\Controllers\SitioController;
use App\Http\Controllers\SolicitudesController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\principalController;


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

Route::get('/', function () {
    return view('Home.index');
});

Route::resource('/objeto', ObjetoController::class);
Route::resource('/sitios', SitioController::class);
Route::resource('/Home', principalController::class);

//Rutas de calendario//
Route::resource('/solicitud', SolicitudesController::class);
Route::delete('solicitud/destroy/{id}', [SolicitudesController::class, 'destroy']); 

Route::get('/solicitud/show/{id}', [SolicitudesController::class, 'show']);
