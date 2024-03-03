<?php

use App\Http\Controllers\HerramientaController;
use App\Http\Controllers\MatConsumibleController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\ReporteController;
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

//rutas de importe de archivos xlsx (excel)
Route::get('/excel/index', [App\Http\Controllers\ExcelController::class, 'index'])->middleware('auth')->name('excel.index');
//ruta de importe y exporte de herrammientas
Route::post('/excel/import', [App\Http\Controllers\ExcelController::class, 'import'])->middleware('auth')->name('excel.import');
// Route::post('/excel/export', [App\Http\Controllers\ExcelController::class, 'export'])->middleware('auth')->name('excel.export');


//ruta de importe y exporte de materiales consumibles
Route::post('/excel/import2', [App\Http\Controllers\ExcelController::class, 'import2'])->middleware('auth')->name('excel.import2');


//rutas de generacion de pdfs
Route::post('/reporte/pdf', [\App\Http\Controllers\ReporteController::class, 'pdf'])->middleware('auth')->name('reporte.pdf');
Route::get('/prestamo/pdf', [App\Http\Controllers\PrestamoController::class, 'pdf'])->middleware('auth')->name('prestamo.pdf');
Route::get('/herramienta/pdf', [App\Http\Controllers\HerramientaController::class, 'pdf'])->middleware('auth')->name('herramienta.pdf');
Route::get('/matConsumible/pdf', [App\Http\Controllers\MatConsumibleController::class, 'pdf'])->middleware('auth')->name('matConsumible.pdf');
Route::get('/registro/pdf', [App\Http\Controllers\RegistroController::class, 'pdf'])->middleware('auth')->name('registro.pdf');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::resource('users', 'UserController');

//rutas madre


Route::resource('/excel', ExcelController::class)->middleware('auth')->names('excel');
Route::resource('/herramienta', HerramientaController::class)->middleware('auth')->names('herramienta');
Route::resource('/matConsumible', MatConsumibleController::class)->middleware('auth')->names('matConsumible');
Route::resource('/prestamo', PrestamoController::class)->middleware('auth')->names('prestamo');
Route::resource('/registro', RegistroController::class)->middleware('auth')->names('registro');
Route::resource('/reporte', ReporteController::class)->middleware('auth')->names('reporte');

