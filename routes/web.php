<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\ChangePassword;
use App\Http\Controllers\Backend\PaisController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ProvinciaController;
use App\Http\Controllers\Backend\ChangePasswordController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('users', UserController::class);
Route::resource('paises', PaisController::class)->parameters(['paises' => 'pais']);
Route::resource('provincias', ProvinciaController::class)->parameters(['provincias' => 'provincia']);
Route::post('users/{user}/change-password', [ChangePasswordController::class, 'change_password'])->name('users.change.password');