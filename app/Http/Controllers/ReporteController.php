<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exceptions\TimeoutException;


class ReporteController extends Controller
{
    public function index(){
        return view('reporte.index');
    }

    public function pdf(Request $request)
    {
        $request->validate([
            'dato' => 'required'
        ]);

        $dato = $request->input('dato');

        set_time_limit(30);

        try {
            // Utiliza where para buscar registros que contengan el dato en cualquier campo
            $datos = Prestamo::where(function ($query) use ($dato) {
                $query->whereRaw('instructor_prestamista like ?', "%$dato%")
                      ->orWhereRaw('nombre_aprendiz like ?', "%$dato%")
                      ->orWhereRaw('ficha_aprendiz like ?', "%$dato%")
                      ->orWhereRaw('id_aprendiz like ?', "%$dato%")
                      ->orWhereRaw('observacion like ?', "%$dato%")
                      ->orWhereRaw('elementos_prestados like ?', "%$dato%");
            })->get();

            if ($datos->isEmpty()) {
                throw new TimeoutException('No se encontraron resultados para la búsqueda.');
            }

            $pdf = Pdf::loadView('reporte.pdf', ['datos' => $datos, 'busqueda' => $dato]);
            return $pdf->stream();

        } catch (Exception $e) {
            if ($e instanceof TimeoutException) {
                return redirect()->route('errors.timeout');
            }
            throw $e;
        }
    }
}
