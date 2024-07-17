<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


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

        // Utiliza where para buscar registros que contengan el dato en cualquier campo
        $datos = Prestamo::where(function ($query) use ($dato) {
            $query->where('instructor_prestamista', 'like', "%$dato%")
                  ->orWhere('nombre_aprendiz', 'like', "%$dato%")
                  ->orWhere('ficha_aprendiz', 'like', "%$dato%")
                  ->orWhere('id_aprendiz', 'like', "%$dato%")
                  ->orWhere('observacion', 'like', "%$dato%")
                  ->orWhere('elementos_prestados', 'like', "%$dato%");
        })->get();

        $pdf = Pdf::loadView('reporte.pdf', ['datos' => $datos, 'busqueda' => $dato]);
        return $pdf->stream();
    }
}
