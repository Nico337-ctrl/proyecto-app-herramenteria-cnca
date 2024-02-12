<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registro; // Asegúrate de importar el modelo Registro
use Carbon\Carbon;
use App\Events\CambioRealizado;
use Barryvdh\DomPDF\Facade\Pdf;

class RegistroController extends Controller
{

    public function index(Registro $registros)
    {
        $registros = Registro::all();
        return view('registro.index', ['registros' => $registros]);
    }

    public function pdf(){
        $registros = Registro::all();
        $pdf = Pdf::loadView('registro.pdf', ['registros'=>$registros]);
        return $pdf->stream();
    }


    public function obtenerTodosLosCambios()
    {
        $registrosHerramientas = Registro::where('origen', 'herramientas')->get();
        $registrosMatConsumibles = Registro::where('origen', 'mat_consumibles')->get();

        // Puedes agregar más tablas según sea necesario

        $todosLosCambios = [
            'herramientas' => $registrosHerramientas,
            'mat_consumibles' => $registrosMatConsumibles,
            // Agrega más arrays según sea necesario
        ];

        return response()->json($todosLosCambios);
    }

    /**
     * Crear un registro para cambios en Herramientas o Materiales Consumibles.
     */
    public function crearRegistro(Request $request)
    {
        // Aquí debes validar y procesar los datos recibidos en $request
        // luego, crear el registro en la tabla 'registros'

        $origen = $request->origen;
        $tipo = $request->tipo;
        $elemento_id = $request->elemento_id;
        $fecha = $request->fecha;

        Registro::create([
            'origen' => $origen,
            'tipo_cambio' => $tipo,
            'elemento_id' => $elemento_id,
            'fecha' => $fecha,
        ]);

        return response()->json(['message' => 'Registro creado exitosamente']);
    }
}
