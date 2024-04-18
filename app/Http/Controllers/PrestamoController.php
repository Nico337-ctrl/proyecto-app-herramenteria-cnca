<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use Illuminate\Http\Request;
use App\Models\Herramienta;
use App\Models\MatConsumible;
use App\Models\Inventario;
use App\Events\CambioRealizado;
use Barryvdh\DomPDF\Facade\Pdf;


class PrestamoController extends Controller
{

    public function index()
    {
        return view('prestamo.index',
        ['prestamos' => Prestamo::all(),
        'mat_consumibles' => MatConsumible::all(),
        'herramientas' => Herramienta::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('prestamo.create',
        ['herramientas' => Herramienta::all(), 'mat_consumibles' => MatConsumible::all()]);
    }

    public function pdf()
    {
        $prestamos = Prestamo::all();
        $pdf = Pdf::loadView('prestamo.pdf', ['prestamos' => $prestamos]);
        return $pdf->stream();
    }

    public function store(Request $request)
    {

        $request->validate([
            'instructor_prestamista' => 'required|max:255',
            'nombre_aprendiz' => 'required|max:255',
            'ficha_aprendiz' => 'required|numeric',
            'id_aprendiz' => 'required|numeric',
            'dias_por_fuera' => 'required|numeric',
            'observacion' => 'required|max:255',
            'usuario_prestamista' => 'required',
            'elementos_prestados' => 'required'
        ]);

        $prestamo = new Prestamo();
        $prestamo->instructor_prestamista = $request->input('instructor_prestamista');
        $prestamo->nombre_aprendiz = $request->input('nombre_aprendiz');
        $prestamo->ficha_aprendiz = $request->input('ficha_aprendiz');
        $prestamo->id_aprendiz = $request->input('id_aprendiz');
        $prestamo->dias_por_fuera = 0;
        $prestamo->observacion = 'ninguna';
        $prestamo->usuario_prestamista = auth()->user()->name;
        $prestamo->elementos_prestados = "Herramientas y Materiales prestados:

        ";

        // Actualiza la cantidad en la tabla MatConsumibles
        foreach ($request->input('mat_consumible_id') as $matConsumibleId) {
            $matConsumible = MatConsumible::find($matConsumibleId);
            $cantidad = $request->input('cantidad.' . $matConsumibleId);

            if ($matConsumible && is_numeric($cantidad) && $cantidad > 0) {
                $matConsumible->cantidad -= $cantidad;
                $matConsumible->save();
            }
        }

        // Cambia el estado de las herramientas a "prestado"
        foreach ($request->input('herramienta_id') as $herramientaId) {
            $herramienta = Herramienta::find($herramientaId);
            if ($herramienta) {
                $herramienta->estado = 'prestado';
                $herramienta->save();
            }
        }

        $prestamo->save();
        $nombre_prestamo = $prestamo->nombre_aprendiz;
        event(new CambioRealizado('prestamo', 'prestamo realizado', $nombre_prestamo, now()));
        return view('prestamo.msg', [
            'prestamos' => Prestamo::all(),
            'herramientas' => Herramienta::all(),
            'mat_consumibles' => MatConsumible::all()
        ]);
    }



    public function show(Prestamo $prestamo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //
        return view('prestamo.edit');
    }
    public function update(Request $request, $id)
    {
        // Validar los campos necesarios
        $request->validate([
            'observacion' => 'required|max:450'
        ]);

        // Buscar el préstamo por ID
        $prestamo = Prestamo::find($id);

        // Verificar si el préstamo existe
        if (!$prestamo) {
            return redirect()->route('prestamo.index')->with('error', 'No se encontró el préstamo.');
        }

        // Actualizar la observación en el préstamo
        $prestamo->observacion = $request->input('observacion');

        // Obtener la herramienta asociada al préstamo
        $herramienta = Herramienta::find($prestamo->herramienta_id);

        // Verificar si hay una herramienta asociada
        if ($herramienta) {
            // Cambiar el estado de la herramienta a "disponible"
            $herramienta->estado = 'disponible';
            $herramienta->save();
        }

        // Obtener el material consumible asociado al préstamo
        $matConsumible = MatConsumible::find($prestamo->mat_consumible_id);

        // Verificar si hay un material consumible asociado
        if ($matConsumible) {
            // Cambiar el estado del material consumible a "disponible"
            $matConsumible->estado = 'disponible';
            $matConsumible->save();
        }

        // Guardar los cambios en el préstamo
        $prestamo->save();
        $nombre_prestamo = $prestamo->nombre_aprendiz;
        event(new CambioRealizado('prestamo', 'prestamo devolucion', $nombre_prestamo, now()));
        return view('prestamo.msg', ['prestamo' => Prestamo::all()]);
    }

    public function destroy($id)
    {
        //
        $prestamo = Prestamo::find($id);
        $prestamo->delete();
        $nombre_prestamo = $prestamo->nombre_aprendiz;
        event(new CambioRealizado('prestamo', 'prestamo eliminado', $nombre_prestamo, now()));
        return redirect('prestamo')->with('delete', 'ok');
    }
}
