<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EmpleadoController;
use App\Http\Controllers\Api\EmpleadoDataController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/empleados/paises', [EmpleadoDataController::class, 'paises']);
Route::get('/empleados/{pais}/provincias', [EmpleadoDataController::class, 'provincias']);
Route::get('/empleados/departamentos', [EmpleadoDataController::class, 'departamentos']);
Route::get('/empleados/{provincia}/ciudades', [EmpleadoDataController::class, 'ciudades']);


Route::get('/empleados', [EmpleadoController::class, 'index']);
Route::post('/empleados', [EmpleadoController::class, 'store']);
