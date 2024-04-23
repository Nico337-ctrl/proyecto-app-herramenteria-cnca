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
    // Validar la entrada del formulario
    $request->validate([
        'instructor_prestamista' => 'required|max:255',
        'nombre_aprendiz' => 'required|max:255',
        'ficha_aprendiz' => 'required|numeric',
        'id_aprendiz' => 'required|numeric',
        'herramientas' => 'required|array',
        'mat_consumibles' => 'nullable|array',
        'cantidad_mat_consumible' => 'nullable|numeric'
    ]);

    // Crear un nuevo objeto de préstamo
    $prestamo = new Prestamo();
    $prestamo->instructor_prestamista = $request->input('instructor_prestamista');
    $prestamo->nombre_aprendiz = $request->input('nombre_aprendiz');
    $prestamo->ficha_aprendiz = $request->input('ficha_aprendiz');
    $prestamo->id_aprendiz = $request->input('id_aprendiz');
    $prestamo->dias_por_fuera = 0;
    $prestamo->observacion = 'ninguna';
    $prestamo->usuario_prestamista = auth()->user()->name;

    // Arrays que contienen las herramientas y materiales seleccionados
    $herramientasSeleccionadas = $request->input('herramientas', []);
    $matConsumiblesSeleccionados = $request->input('mat_consumibles', []);
    $cantidad_mat_consumible = $request->input('cantidad_mat_consumible');

    // Texto para almacenar descripciones de elementos prestados
    $elementosPrestados = "";

    // Iterar sobre herramientas seleccionadas y obtener sus descripciones
    foreach ($herramientasSeleccionadas as $herramientaId) {
        $herramienta = Herramienta::find($herramientaId);
        if ($herramienta) {
            // Cambia el estado de la herramienta a "prestado"
            $herramienta->estado = 'prestado';
            $herramienta->save();

            // Agregar la descripción de la herramienta al texto
            $elementosPrestados .= "{$herramienta->codigo} - {$herramienta->descripcion}, ";
        }
    }

    // Iterar sobre materiales consumibles seleccionados y obtener sus descripciones
    foreach ($matConsumiblesSeleccionados as $matConsumibleId) {
        $matConsumible = MatConsumible::find($matConsumibleId);
        if ($matConsumible) {
            // Actualiza la cantidad y cambia el estado si es necesario
            $cantidad = $request->input('cantidad.' . $matConsumibleId);
            if (is_numeric($cantidad_mat_consumible) && $cantidad_mat_consumible > 0) {
                $matConsumible->cantidad -= $cantidad_mat_consumible;
                $matConsumible->save();

                if ($matConsumible->cantidad <= 0) {
                    $matConsumible->estado = 'agotado';
                }

                // Agregar la descripción del material consumible al texto
                $elementosPrestados .= "{$matConsumible->codigo} - {$matConsumible->descripcion}, ";
            }
        }
    }

    // Quitar la última coma y espacio del texto
    $elementosPrestados = rtrim($elementosPrestados, ", ");

    // Asignar el texto de elementos prestados al campo del préstamo
    $prestamo->elementos_prestados = $elementosPrestados;

    // Guardar el préstamo
    $prestamo->save();

    // Emitir evento para notificar sobre el préstamo realizado
    event(new CambioRealizado('prestamo', 'Préstamo realizado', $prestamo->nombre_aprendiz, now()));

    // Retornar una vista con los datos actualizados
    return view('prestamo.msg', [
        'prestamos' => Prestamo::all(),
        'herramientas' => Herramienta::all(),
        'mat_consumibles' => MatConsumible::all(),
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
