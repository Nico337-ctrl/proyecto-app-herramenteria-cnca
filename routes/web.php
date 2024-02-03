<?php

use App\Http\Controllers\HerramientaController;
use App\Http\Controllers\MatConsumibleController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\RegistroController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/herramienta/pdf', [App\Http\Controllers\HerramientaController::class, 'pdf'])->middleware('auth')->name('herramienta.pdf');
Route::get('/matConsumible/pdf', [App\Http\Controllers\MatConsumibleController::class, 'pdf'])->middleware('auth')->name('matConsumible.pdf');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::resource('users', 'UserController');

//rutas generales
Route::resource('/herramienta', HerramientaController::class)->middleware('auth')->names('herramienta');
Route::resource('/matConsumible', MatConsumibleController::class)->middleware('auth')->names('matConsumible');
Route::resource('/prestamo', PrestamoController::class)->middleware('auth')->names('prestamo');
Route::resource('/registro', RegistroController::class)->middleware('auth')->names('registro');


